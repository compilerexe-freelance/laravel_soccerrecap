@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="padding-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <span class="font-color-gray" style="font-size: 12px;">TAGGED IN</span>
                </div>
                <div class="form-group" style="//border: 1px solid red;">

                    <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                        <div class="form-group" style="//margin-top: 20px;">
                            <span style="font-size: 26px">Artificial Intelligence</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 text-right">
                        <div class="form-group" style="//margin-top: 25px;">
                            <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876">Follow</button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr style="margin: 0px">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-fulid">
                            <div class="form-inline">
                                <div class="form-group" style="margin-top: 20px;">
                                    <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                                </div>
                                <div class="form-group">
                            <span for="" style="margin-left: 10px;" class="font-color-blue">Macbook Pro<br>
                                <span style="margin-left: 10px; font-size: 12px !important;" class="font-color-gray">2017/01/02 21:30</span>
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="margin-top: 20px; padding-bottom: 10px;">
                            <div class="form-group">
                                <a href="read_story.php"><img src="https://stories-app.s3.amazonaws.com/uploads/post/picture/734/thumb_AAEAAQAAAAAAAAYcAAAAJDgwZTVmMDdjLTVjMWMtNGY2My1hMThhLWYyZmVmYzY0NDZkMw.jpg" alt="" class="img-responsive"></a>
                            </div>
                            <div class="form-group">
                                <a href="read_story.php"><h3 style="font-weight: bold;">How to become an entrepreneur!!</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">Hello world! This is a test!!!</span>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                                <i class="fa fa-eye" style="margin-left: 10px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                                <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>

                                <a href="#"><span class="font-color-gray pull-right">Bookmark <i class="fa fa-bookmark-o"></i></span></a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-5" style="background-color: #FAFAFA; padding-top: 20px;">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <small><b>TOP STORIES</b></small>
            </div>

            <div class="form-group">
                <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                    <div class="text-cycle">
                        <span>1</span>
                    </div>
                </div>
                <div class="col-xs-11 col-sm-12 col-md-11">
                    <span style="padding-left: 10px; line-height: 35px;">How to become an entrepreneur!!</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Macbook Pro</span>
                    <hr style="border-color: #f2f2f2">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                    <div class="text-cycle">
                        <span>2</span>
                    </div>
                </div>
                <div class="col-xs-11 col-sm-12 col-md-11">
                    <span style="padding-left: 10px; line-height: 35px;">Intel 2017</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Tester</span>
                    <hr style="border-color: #f2f2f2">
                </div>
            </div>
        </div>

    </div>

@endsection