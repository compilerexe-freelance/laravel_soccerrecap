@extends('layouts.layout_admin')

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 animated fadeIn" style="margin-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="font-size: 16px; font-weight: bold;">Authentication</span>
            </div>
            <div class="panel-body">
                <form action="{{ url('auth/administrator') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span style="font-size: 16px;">Username</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="font-size: 16px;" name="username" required autofocus>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 16px;">Password</span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" style="font-size: 16px;" name="password" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-bg-green">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection