@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar_write_story')
@endsection

@section('content')

    <div class="panel panel-default" style="-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2" style="//border: 1px solid red;">

                <div class="form-group text-right">
                    <a href="{{ url('my_stories') }}"><button type="button" class="btn btn-bg-green font-color-blue" style="font-size: 16px; width: 150px;"><i class="fa fa-angle-double-left"></i> Back</button></a>
                </div>

                <form action="{{ url('update_story/'.$story->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group" style="//margin-top: 20px;">
                        <div class="form-inline">
                            <div class="form-group">

                                @if (file_exists(public_path('uploads/profile_images/'.Auth::user()->id)))
                                    <img src="{{ url('uploads/profile_images/'.Auth::user()->id) }}"
                                         style="width: 50px !important; height: 50px !important;"
                                         class="img-circle"
                                         alt="">
                                @else
                                    <img src="{{ url('images/icons/user.png') }}"
                                         style="width: 50px !important; height: 50px !important;"
                                         class="img-circle"
                                         alt="">
                                @endif

                            </div>
                            <div class="form-group">
                                <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ Auth::user()->username }}<br><span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">Update Story</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="story_title" class="form-control border-none input-lg" style="font-size: 38px; border-bottom: 1px solid #fff !important;" value="{{ $story->story_title }}" placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                            <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                        @endif
                    </div>

                    <div class="form-group">
                        <span class="font-color-gray" style="font-size: 16px;">Select your image story</span>
                        <input type="file" name="story_picture" id="story_picture">
                    </div>

                    <div class="form-group">
                        <textarea name="story_detail" class="summernote">{!! $story->story_detail !!}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <span style="font-size: 16px;" class="font-color-gray">Add tags to reach more people</span>
                    </div>

                    @php
                        $tag_1 = ""; $tag_2 = ""; $tag_3 = ""; $tag_4 = ""; $tag_5 = "";
                        $tag_id_1 = ""; $tag_id_2 = ""; $tag_id_3 = ""; $tag_id_4 = ""; $tag_id_5 = "";

                        foreach ($tags as $key => $tag) {
                            if ($key == 0) {
                                $tag_1 = $tag->tag_name;
                                $tag_id_1 = $tag->id;
                            } else if ($key == 1) {
                                $tag_2 = $tag->tag_name;
                                $tag_id_2 = $tag->id;
                            } else if ($key == 2) {
                                $tag_3 = $tag->tag_name;
                                $tag_id_3 = $tag->id;
                            } else if ($key == 3) {
                                $tag_4 = $tag->tag_name;
                                $tag_id_4 = $tag->id;
                            } else {
                                $tag_5 = $tag->tag_name;
                                $tag_id_5 = $tag->id;
                            }
                        }
                    @endphp

                    <div class="form-group">
                        <input type="text" name="tag_1" class="form-control input-lg border-none" value="{{ $tag_1 }}" placeholder="Tag 1">
                        <input type="hidden" name="tag_id_1" class="form-control input-lg border-none" value="{{ $tag_id_1 }}" placeholder="Tag 1">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tag_2" class="form-control input-lg border-none" value="{{ $tag_2 }}" placeholder="Tag 2">
                        <input type="hidden" name="tag_id_2" class="form-control input-lg border-none" value="{{ $tag_id_2 }}" placeholder="Tag 2">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tag_3" class="form-control input-lg border-none" value="{{ $tag_3 }}" placeholder="Tag 3">
                        <input type="hidden" name="tag_id_3" class="form-control input-lg border-none" value="{{ $tag_id_3 }}" placeholder="Tag 3">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tag_4" class="form-control input-lg border-none" value="{{ $tag_4 }}" placeholder="Tag 4">
                        <input type="hidden" name="tag_id_4" class="form-control input-lg border-none" value="{{ $tag_id_4 }}" placeholder="Tag 4">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tag_5" class="form-control input-lg border-none" value="{{ $tag_5 }}" placeholder="Tag 5">
                        <input type="hidden" name="tag_id_5" class="form-control input-lg border-none" value="{{ $tag_id_5 }}" placeholder="Tag 5">
                    </div>

                    <div class="form-group text-center" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-success btn-bg-green" style="width: 150px; font-size: 16px;">Publish <i class="fa fa-paper-plane"></i></button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#story_picture").fileinput({showCaption: false, showUpload: false});

            $('.summernote').summernote({
                //toolbar: false,
                height: 500,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });

        });
    </script>

@endsection