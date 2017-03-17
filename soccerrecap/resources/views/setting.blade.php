@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar_profile')
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <form action="#" method="post">
                    <div class="form-group">
                        <span style="font-size: 28px;" class="font-color-green">Setting</span>
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
                        <span style="font-size: 28px;" class="font-color-green">Information</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control border-none input-lg" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control border-none input-lg" placeholder="Re-enter Password">
                    </div>
                    <div class="form-group text-right" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-success btn-bg-green" style="width: 150px;">Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection