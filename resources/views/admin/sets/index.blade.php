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
                            <h4 class="title">Sets
                                <a href="{{ url('admin/sets/create') }}" class="btn btn-info btn-fill pull-right">Add New Set</a>
                            </h4>
                        </div>

                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Operations</th>
                                </thead>
                                <tbody>
                                @foreach ($sets as $set)
                                    <tr>
                                        <td>{{ $set->id }}</td>
                                        <td>{{ $set->title }}</td>
                                        <td>
                                            @if($set->image != "")
                                                <img src="{{url('public/imgs/sets/'.$set->image)}}" height="100"
                                                     align="middle"/></td>
                                        @else <img src="{{url('public/imgs/default.png')}}" height="100"
                                                   align="middle"/></td>
                                        @endif
                                        <td>{{ $set->description }}</td>
                                        <td>
                                            <a href="{{ url('admin/sets/'.$set->id.'/edit') }}"
                                               class="btn btn-info btn-fill btn-block">Edit</a>
                                            @if($set->status == 0)
                                                {{--//if status = 0 a button click turns 0 to 1--}}
                                                <a title="change status"
                                                   href="{{ url('admin/sets/status/'.$set->id) }}"
                                                   class="btn btn-info btn-fill btn-block">Active</a>
                                            @else
                                                {{--//if status = 1 a button click turns 1 to 0--}}
                                                <a title="change status"
                                                   href="{{ url('admin/sets/status/'.$set->id) }}"
                                                   class="btn btn-info btn-fill btn-block">Not Active</a>
                                            @endif
                                            &nbsp;
                                            {!! Form::open(['method' => 'Delete', 'route' => ['sets.destroy', $set->id ]]) !!}
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