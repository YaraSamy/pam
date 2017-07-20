@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        {!! Form::open(['url' => 'admin/movies', 'files' => true]) !!}

        <div class="row">
            <div class="col-md-4">
                <label>Movie Set*</label>
                <div class="form-group">
                    <div class="dropdown">
                        <select id="set_id" name="set_id" class="form-control" required>
                            @foreach($sets as $set)
                                <option value="{{$set->id}}"> {{$set->title}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label>Movie Tilte*</label>
                <div class="form-group">
                    <input id="title" type="text" name="title" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Status*</label>
                <div class="form-group">
                    <div class="radio">
                        <label><input type="radio" name="status" value="0" required>Inactive</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="status" value="1" required>Active</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Image</label>
                <div class="form-group">
                    {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Created date*</label>
                <div class="form-group">
                    <input id="created_date" name="created_date" type="date" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Description</label>
                <div class="form-group">
                    <textarea id="description" name="description" rows="4" class="form-control" placeholder="movie description here"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-info btn-fill pull-left">Add Movie</button>
        <div class="clearfix"></div>
        {!! Form::close() !!}
    </div>

@endsection