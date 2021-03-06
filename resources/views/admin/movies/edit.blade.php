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
        {!! Form::model($movie, [
                'files'=>true , //to allow image upload
                'method'=>'patch',
                'route' => ['movies.update', $movie->id]  ]) !!}

        <div class="row">
            <div class="col-md-4">
                <label>Movie Set</label>
                <div class="form-group">
                    <div class="dropdown">
                        <select id="set_id" name="set_id" class="form-control">
                            @foreach($sets as $set)
                                <option value="{{$set->id}}"> {{$set->title}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Tilte</label>
                <div class="form-group">
                    <input id="title" type="text" name="title" class="form-control" value="{{ $movie->title }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Status</label>
                <div class="form-group">
                    @if($movie->status == 0)
                        <div class="radio checked">
                            <label><input type="radio" checked name="status" value="0">Inactive</label>
                        </div>
                        <div class="radio ">
                            <label><input type="radio" name="status" value="1">Active</label>
                        </div>
                    @else
                        {{--status 1 --}}
                        <div class="radio  ">
                            <label><input type="radio" name="status" value="0">Inactive</label>
                        </div>
                        <div class="radio checked">
                            <label><input type="radio" checked name="status" value="1">Active</label>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <label>Image</label>
                <div class="form-group">
                    @if($movie->image != "")
                        <img src="{{url('public/imgs/movies/'.$movie->image)}}" height="100"
                             align="middle"/>
                    @else <img src="{{url('public/imgs/default.png')}}" height="100"
                               align="middle"/>
                    @endif
                    <input name="thumb" type="file">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Created date</label>
                <div class="form-group">
                    <input id="created_date" name="created_date" value="{{ $movie->created_date }}" type="date">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Description</label>
                <div class="form-group">
                    <textarea id="description" name="description" rows="5" class="form-control"
                              placeholder="set description here"> {{ $movie->description }} </textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-info btn-fill pull-left">Submit Change</button>
        <div class="clearfix"></div>
        {!! Form::close() !!}

    </div>
@endsection