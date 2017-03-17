@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar_profile')
@endsection

@section('content')

    <img src="{{ url('images/cover.jpg') }}" style="width: 100%; height: 250px;" alt="">

    <div class="panel panel-default" style="-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-right">
                    <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 130px; color: #03B876"><i class="fa fa-upload"></i> Edit Cover</button>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <div class="col-xs-12 col-sm-12 col-md-9" style="margin-top: 10px; //border: 1px solid blue; //padding-bottom: 32px;">
                    <div class="form-group">
                        <span style="font-size: 30px; font-weight: bold;">Macbook Pro</span>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <span style="font-size: 18px;" class="font-color-gray"><b>0</b> Following <b>0</b> Followers <br><br><b>20</b> Tag Following <b>10,000</b> Like</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3" style="margin-top: 10px; //border: 1px solid red">
                    <div class="form-group">
                        <img src="{{ url('images/icons/me.jpg') }}" style="//width: 90px; //heigth: 90px; width: 100%;" class="img-circle" alt="">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876"><i class="fa fa-upload"></i> Edit</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <hr>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 20px" class="font-color-gray">Profile describe ...</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-9">
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876"><i class="fa fa-pencil"></i> Edit</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection