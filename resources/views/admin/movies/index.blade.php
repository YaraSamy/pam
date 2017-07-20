@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    {{-- Shows message after create, update & delete --}}
                    @if( Session::has('done') )
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>{{Session::get('done')}}</div>
                    @endif

                    <div class="card">
                        <div class="header">
                            <h4 class="title">Movies
                                <a href="{{ url('admin/movies/create') }}" class="btn btn-info btn-fill pull-right">Add
                                    New Movie</a>
                            </h4>
                        </div>

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Movie Set</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Operations</th>
                                </thead>
                                <tbody>
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td>{{ $movie->id }}</td>
                                        <td>{{ $movie->set_id }}</td>
                                        <td>{{ $movie->title }}</td>
                                        <td>
                                            @if($movie->image != "")
                                                <img src="{{url('public/imgs/movies/'.$movie->image)}}" height="100"
                                                     align="middle"/>
                                            @else <img src="{{url('public/imgs/default.png')}}" height="100"
                                                       align="middle"/>
                                            @endif
                                        </td>
                                        <td>{{ $movie->description }}</td>
                                        <td>{{ $movie->created_date }}</td>
                                        <td>
                                            <a href="{{ url('admin/movies/'.$movie->id.'/edit') }}"
                                               class="btn btn-info btn-fill btn-block">Edit</a>
                                            @if($movie->status == 0)
                                                {{--//if status = 0 a button click turns 0 to 1--}}
                                                <a title="change status"
                                                   href="{{ url('admin/movies/status/'.$movie->id) }}"
                                                   class="btn btn-info btn-fill btn-block">Active</a>
                                            @else
                                                {{--//if status = 1 a button click turns 1 to 0--}}
                                                <a title="change status"
                                                   href="{{ url('admin/movies/status/'.$movie->id) }}"
                                                   class="btn btn-info btn-fill btn-block">Not Active</a>
                                            @endif
                                            &nbsp;
                                            {!! Form::open(['method' => 'Delete', 'route' => ['movies.destroy', $movie->id ]]) !!}
                                            <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection