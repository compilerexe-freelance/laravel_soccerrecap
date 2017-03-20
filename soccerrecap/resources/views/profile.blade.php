@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    @php
        $profile = App\Profile::find(Auth::user()->id);
    @endphp

    @if ($profile)

    @else
        <div style="width: 100%; height: 250px; background-color: #9acfea"></div>
    @endif

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
                        <span style="font-size: 30px; font-weight: bold;">{{ Auth::user()->username }}</span>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <span style="font-size: 18px;" class="font-color-gray"><b>0</b> Following <b>0</b> Followers <br><br><b>0</b> Tag Following <b>0</b> Like</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3" style="margin-top: 10px; //border: 1px solid red">
                    <div class="form-group">

                        @if ($profile->image_profile != null)
                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('image_profiles/'.Auth::user()->id)) }}" style="//width: 90px; //heigth: 90px; width: 100%;" class="img-circle">
                        @else
                            <img src="{{ url('images/icons/user.png') }}" style="//width: 90px; //heigth: 90px; width: 100%;" class="img-circle" alt="">
                        @endif
                    </div>

                    <form action="{{ url('profile/update_image') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="file" name="image_profile" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-bg-green btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                    </form>

                </div>

                <form action="{{ url('profile/update_describe') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <hr>
                        </div>
                        <div class="form-group">
                            {{--<span style="font-size: 20px" class="font-color-gray">Profile describe ...</span>--}}
                            <textarea id="summernote" name="describe_profile">{!! $profile->describe_profile !!}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-9">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-bg-green btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>

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