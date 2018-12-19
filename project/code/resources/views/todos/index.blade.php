@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif

      @if(count($items) > 0)
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Id</th>
            <th>UserId</th>
            <th>Title</th>
            <th>Completed</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($items as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->userId }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->completed == 1 ? 'Yes' : 'No' }}</td>
              <td>
                <form action="{{ route('todosDelete', $item->id) }}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <div class="btn-group">
                    <a href="{{ route('todosEdit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <button type="submit" class="btn btn-sm btn-danger "
                            onclick="return confirm('Are you sure to delete?')">Delete
                    </button>
                  </div>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>




      @else
        <p>No items</p>
      @endif

      {{ $items->links() }}
    </div>
  </div>
@endsection