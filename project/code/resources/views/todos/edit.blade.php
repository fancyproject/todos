@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Edit #{{ $item->id }}</h1>

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('todosUpdate',$item->id) }}" method="POST">

      {{ csrf_field() }}

      <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
            <strong>User id:</strong>
            <input type="text" name="userId" value="{{ $item->userId }}" class="form-control" placeholder="User id">
          </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="title" value="{{ $item->title }}" class="form-control" placeholder="Title">
          </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
            <strong>Completed: </strong>
            <input type="hidden" name="completed" value="0">
            <input type="checkbox" name="completed" value="1"
                   @if($item->completed == 1)
                   checked
                    @endif
            >
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </div>

    </form>
  </div>
@endsection