@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <form action="{{ url('update_password') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span style="font-size: 28px;" class="font-color-blue">Setting</span>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                            <span style="font-size: 19px;" class="font-color-gray">Newsletter</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                            <label class="switch">
                                <input type="checkbox">
                                <div class="slider round"></div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <span style="font-size: 28px;" class="font-color-blue">Change Password</span>
                    </div>
                    <div class="form-group text-right">
                        <span style="color: red;">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control border-none input-lg" placeholder="Password (8 characters minimum)" min="8" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control border-none input-lg" placeholder="Re-enter Password" required>
                    </div>
                    <div class="form-group text-right" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-success btn-bg-green" style="width: 150px;"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection