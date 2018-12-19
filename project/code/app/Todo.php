<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
//    /** @var int */
//    public $userId;
//
//    /** @var int */
//    public $id;
//
//    /** @var string */
//    public $title;
//
//    /** @var bool */
//    public $completed;

    protected $table = 'todos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'title', 'completed',
    ];
}
