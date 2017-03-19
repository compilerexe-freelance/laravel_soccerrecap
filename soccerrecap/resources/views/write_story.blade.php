@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar_write_story')
@endsection

@section('content')

    <div class="panel panel-default" style="-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2" style="//border: 1px solid red;">

                <div class="form-group" style="//margin-top: 20px;">
                    <div class="form-inline">
                        <div class="form-group">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                        </div>
                        <div class="form-group">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro<br><span style="margin-left: 10px; font-size: 12px !important;" class="font-color-gray">New Post</span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control border-none input-lg" style="font-size: 38px; border-bottom: 1px solid #fff !important;" placeholder="Title" autofocus>
                </div>

                <div class="form-group">
                    <label class="control-label">Select file your image story</label>
                    <input id="input-fileupload" name="input-fileupload[]" type="file" required>
                </div>

                <div class="form-group">
                    <div id="summernote"></div>
                </div>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#input-fileupload").fileinput({showCaption: false, showUpload: false});

            $('#summernote').summernote({
                //toolbar: false,
                height: 500,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });
        });
    </script>

@endsection