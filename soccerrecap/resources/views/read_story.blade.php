@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar_read_story')
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <!-- Header -->
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px !important; padding-right: 0px !important;">
                    <div class="col-xs-7 col-sm-12 col-md-4">
                        <div class="form-group" style="margin-top: 20px;">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-12 col-md-8">
                        <div class="form-group text-right" style="margin-top: 20px;">
                            <button type="button" class="btn btn-success bg-success btn-remove-shadow" style="background-color: #03B876 !important;"><i class="fa fa-facebook"></i> SHARE</button>
                        </div>
                    </div>
                </div>

                <!-- Article Image -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <img src="https://stories-app.s3.amazonaws.com/uploads/post/picture/734/thumb_AAEAAQAAAAAAAAYcAAAAJDgwZTVmMDdjLTVjMWMtNGY2My1hMThhLWYyZmVmYzY0NDZkMw.jpg" alt="" style="width: 100%">
                    </div>
                </div>

                <!-- Article Detail -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <span style="font-size: 30px;"><b>How to become an entrepreneur!!</b></span>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 20px;" class="font-color-gray">Hello world! This is a test!!!</span>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-tags"></i> Programmer, Coding
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-remove-shadow" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                        <i class="fa fa-eye" style="margin-left: 10px;"></i>
                        <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                        <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                        <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>

                        <a href="#"><span class="font-color-gray pull-right">Bookmark <i class="fa fa-bookmark-o"></i></span></a>
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>

                    <!-- Author Icon -->
                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px !important; padding-right: 0px !important;">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 text-center" style="//border: 1px solid red">
                            <div class="form-group" style="//margin-top: 20px;">
                                <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                                <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 14px; font-weight: normal; //margin-left: 94px;" class="font-color-gray">Profile describe ...</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-2 text-center" style="//border: 1px solid red">
                            <div class="form-group" style="//margin-top: 25px;">
                                <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876">Follow</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; padding-left: 0px !important; //padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's HTML</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; //padding-left: 0px !important; //padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's CSS</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; //padding-left: 0px !important; padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's PHP</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <span style="font-size: 14px; font-weight: bold;">RESPONSES</span>
                    </div>
                    <!-- Header -->
                    <div class="form-group" style="margin-top: 20px;">
                        <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                        <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                    </div>
                    <div class="form-group">
                        <div id="summernote"></div>
                    </div>
                    <div class="form-group text-right" style="margin-top: 20px;">
                        <button type="button" class="btn btn-success bg-success" style="background-color: #03B876 !important; font-size: 16px; width: 120px;">Publish</button>
                        <button type="button" class="btn btn-success bg-success font-color-green" style="font-size: 16px; width: 120px;">Cancle</button>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-3">
                    <!-- Header -->
                    <div class="form-group" style="margin-top: 20px;">
                        <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                        <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro <span class="font-color-gray pull-right">7 days ago</span></span>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 18px;">Detail 1 ...</span>
                    </div>
                    <hr>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <!-- Header -->
                    <div class="form-group" style="margin-top: 20px;">
                        <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                        <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro <span class="font-color-gray pull-right">10 days ago</span></span>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 18px;">Detail 2 ...</span>
                    </div>
                    <hr>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: false,
                height: 150,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });
        });
    </script>

@endsection