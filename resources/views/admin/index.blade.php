@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row" align="middle">
                <div class="col-md-4">
                    <div class="card" align="middle">
                        <div class="header">
                            <h4 class="title">Admins</h4>
                        </div>
                        <div class="content">
                            <img src="{{ url('public/imgs/icons/admin.png') }}" width="80" height="80">
                            <H1>{{ $admins_count }}</H1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" align="middle">
                        <div class="header">
                            <h4 class="title">Sets</h4>
                        </div>
                        <div class="content">
                            <img src="{{ url('public/imgs/icons/sets.png') }}" width="80" height="80">
                            <H1>{{ $sets_count }}</H1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" align="middle">
                        <div class="header">
                            <h4 class="title">Movies</h4>
                        </div>
                        <div class="content">
                            <img src="{{ url('public/imgs/icons/movies.png') }}" width="80" height="80">
                            <H1>{{ $movies_count }}</H1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection