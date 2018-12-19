<?php

namespace App\Console\Commands;

use App\Service\TodoReceiverService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReceiveTodos extends Command
{
    const MAX_ITEMS_TO_INSERT = 100;

    const SQL_PATTERN = "
        INSERT INTO todos (id, userId, title, completed) 
           VALUES %s 
           ON DUPLICATE KEY UPDATE 
            id = VALUES(id),
            userId = VALUES(userId),
            title = VALUES(title),
            completed = VALUES(completed)";

    /** @var TodoReceiverService */
    private $todoReceiverService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receive:todos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receive todos from api';

    /**
     * @param TodoReceiverService $todoReceiverService
     */
    public function __construct(TodoReceiverService $todoReceiverService)
    {
        parent::__construct();
        $this->todoReceiverService = $todoReceiverService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Start receiving data');

        $items = $this->todoReceiverService->getItems();
        if ($items === null) {
            $this->comment('Problem with receiving data');
            return;
        }
        $this->comment(sprintf('Found %d items', count($items)));

        $packages = array_chunk($items, self::MAX_ITEMS_TO_INSERT);
        $count = count($packages);

        foreach ($packages as $counter => $package) {
            $this->comment(sprintf('Insert/update package %d/%d', $counter + 1, $count));
            $sqlParts = [];
            foreach ($package as $item) {
                $sqlParts[] = sprintf("(%d, %d, '%s', %d)",
                    $item->id,
                    $item->userId,
                    $item->title,
                    $item->completed
                );
            }

            // use multiple insert/update sql
            $sql = sprintf(self::SQL_PATTERN, implode(',', $sqlParts));
            DB::statement($sql);
        }

        $this->comment('End receiving data');
    }
}
