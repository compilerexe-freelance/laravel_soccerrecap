@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="panel panel-default" style="-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body" style="padding-top: 0px !important;">

            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-fulid text-center">
                @if (file_exists(public_path('uploads/profile_covers/'.Auth::user()->id)))
                    <img src="{{ url('uploads/profile_covers/'.Auth::user()->id) }}" style="width: 851px; height: 315px;">
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px; //border: 1px solid blue; //padding-bottom: 32px;">
                    <form action="{{ url('profile/update_cover') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group text-right">
                            <span class="font-color-gray" style="font-size: 16px;">Select image your cover profile</span>
                            <input type="file" name="cover_profile" id="cover_profile">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success btn-bg-green border-green btn-remove-shadow" style="width: 115px;"><i class="fa fa-upload"></i> Upload</button>
                        </div>

                    </form>
                    <hr>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-9" style="margin-top: 10px; //border: 1px solid blue; //padding-bottom: 32px;">
                    <div class="form-group">
                        <span style="font-size: 30px; font-weight: bold;">{{ Auth::user()->username }}</span>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <span style="font-size: 18px;" class="font-color-gray">
                            <b>{{ $following }}</b> Following
                            <a href="{{ url('list/followers/'.Auth::user()->id) }}"><b>{{ $followers }}</b> Followers</a>
                            <br><br>
                            <a href="{{ url('list/tag_following/'.Auth::user()->id) }}"><b>{{ $tag_following }}</b> Tag Following</a>
                            <b>{{ $total_like }}</b> Like
                        </span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3" style="margin-top: 10px; //border: 1px solid red">
                    <div class="form-group">
                        @if (file_exists(public_path('uploads/profile_images/'.Auth::user()->id)))
                            <img src="{{ url('uploads/profile_images/'.Auth::user()->id) }}" style="//width: 90px; //heigth: 90px; width: 100px; height: 100px;" class="img-circle">
                        @else
                            <img src="{{ url('images/icons/user.png') }}" style="//width: 90px; //heigth: 90px; width: 100px; height: 100px;" class="img-circle" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <form action="{{ url('profile/update_image') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group text-right">
                            <span class="font-color-gray" style="font-size: 16px;">Select image your profile</span>
                            <input type="file" name="profile_image" id="profile_image">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success btn-bg-green border-green btn-remove-shadow" style="width: 115px;"><i class="fa fa-upload"></i> Upload</button>
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
                            <button type="submit" class="btn btn-success btn-bg-green border-green btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>

                @foreach ($storys as $story)

                    @php
                        $member = \App\Member::find($story->member_id);
                        $comment = \App\Comment::where('story_id', $story->id)->get();
                        $count = \App\StoryCount::find($story->id);
                    @endphp

                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="form-inline">
                                        <div class="form-group" style="margin-top: 20px;">
                                            @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                            @else
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; heigth: 50px;" class="" alt=""></a>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                    <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="{{ url('/story/'.$story->id) }}"><h3>{{ $story->story_title }}</h3></a>
                                </div>
                                <div class="form-group">
                                    @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                        <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 18px;" class="font-color-gray">{!! str_limit($story->story_detail, 100) !!}</span>
                                </div>
                                <div class="form-group text-right" style="margin-top: 20px; //padding-bottom: 50px;">

                                    {{--<button type="button" id="btn_like_story_{{ $story->id }}" class="btn btn-info btn-remove-hover" style="width: 120px; border-radius: 20px; color: dodgerblue">--}}
                                        {{--<i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>--}}
                                        {{--<span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>--}}
                                    {{--</button>--}}

                                    <a href="#" id="btn_like_story_{{ $story->id }}" class="font-color-blue" style="font-size: 16px !important;">
                                        <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                        <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                                    </a>

                                    <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ number_format($count->count_view) }}</span>

                                    <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ count($comment) }}</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::check())
                        <script>
                            $(document).ready(function() {
                                $('#btn_like_story_{{ $story->id }}').on('click', function() {
                                    $.post('{{ url('like_story/'.$story->id.'/'.Auth::user()->id) }}', {
                                            _token: '{{ csrf_token() }}',
                                            story_id: '{{ $story->id }}',
                                            member_id: '{{ Auth::user()->id }}'
                                        },
                                        function(data, status) {
                                            if (status) {
                                                $('#story_{{ $story->id }}_like').text(data);
//                                        console.log("Data: " + data + "\nStatus: " + status);
//                                        console.log(typeof (data));
                                            }
                                        });
                                });
                            });
                        </script>
                    @endif

                @endforeach

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#cover_profile").fileinput({showCaption: false, showUpload: false});
            $("#profile_image").fileinput({showCaption: false, showUpload: false});

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