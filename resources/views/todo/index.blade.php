@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('todos.create') }}"> Tambah Todo</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <!-- <th>S.No</th> -->
            <th>Title</th>
            <th>Detail</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($tods as $todos_data)
        <tr>
            <td>{{ $todos_data->title }}</td>
            <td>{{ $todos_data->detail }}</td>
            <td>{{ $todos_data->status }}</td>
            <td>
                <div >
                    <a class="btn btn-warning" href="todos_proses/{{ $todos_data->id }}">On-Proses</a>
                    <a class="btn btn-success" href="todos_done/{{$todos_data->id}}">Done</a>
                </div><br>
                <!-- <div style="padding-top: 1px;"></div> -->
                <div >
                    <form action="{{ route('todos.destroy',$todos_data->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('todos.edit',$todos_data->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $tods->links() !!}
</div>
@endsection