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
        {!! Form::open(['url' => 'admin/sets', 'files' => true]) !!}

        <div class="row">
            <div class="col-md-4">
                <label>Tilte*</label>
                <div class="form-group">
                    <input id="title" type="text" name="title" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Status*</label>
                <div class="radio">
                    <label><input type="radio" name="status" value="0" required>Inactive</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="status" value="1" required>Active</label>
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
                <label>Description</label>
                <div class="form-group">
                    <textarea id="description" name="description" rows="5" class="form-control" placeholder="set description here"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-info btn-fill pull-left">Add Set</button>
        <div class="clearfix"></div>
        {!! Form::close() !!}
</div>

@endsection