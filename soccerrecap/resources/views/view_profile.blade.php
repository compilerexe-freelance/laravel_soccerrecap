@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    {{--@php--}}
    {{--$profile = App\Profile::find(Auth::user()->id);--}}
    {{--@endphp--}}

    {{--@if ($profile)--}}

    {{--@else--}}
    {{--<div style="width: 100%; height: 250px; background-color: #9acfea"></div>--}}
    {{--@endif--}}

    <div class="panel panel-default" style="margin-top: 20px; -webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body" style="padding-top: 0px !important;">

            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-fulid text-center">
                @if (Storage::has('profile_covers/'.$member->id))
                    <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_covers/'.$member->id)) }}" style="width: 851px; height: 315px;">
                @endif
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <div class="col-xs-12 col-sm-12 col-md-9" style="margin-top: 10px; //border: 1px solid blue; //padding-bottom: 32px;">
                    <div class="form-group">
                        <span style="font-size: 30px; font-weight: bold;">{{ $member->username }}</span>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <span style="font-size: 18px;" class="font-color-gray"><b>{{ $following }}</b> Following <b>{{ $followers }}</b> Followers <br><br><b>0</b> Tag Following <b>{{ $total_like }}</b> Like</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3" style="margin-top: 10px; //border: 1px solid red">
                    <div class="form-group">
                        @if (Storage::has('profile_images/'.$member->id))
                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_images/'.$member->id)) }}" style="//width: 90px; //heigth: 90px; width: 100%;" class="img-circle">
                        @else
                            <img src="{{ url('images/icons/user.png') }}" style="//width: 90px; //heigth: 90px; width: 100%;" class="img-circle" alt="">
                        @endif
                    </div>
                    <div class="form-group">

                        @if (Auth::check())

                            @php
                                $follow_check = \App\FollowsMember::where('member_id', Auth::user()->id)
                                ->where('follow_member_id', $member->id)
                                ->first();
                            @endphp

                            @if ($member->id != Auth::user()->id)

                                @if ($follow_check)
                                    <button type="button" id="btn_unfollow" class="btn btn-success btn-bg-green" style="border-radius: 20px; width: 100px; color: #03B876">Unfollow</button>
                                @else
                                    <button type="button" id="btn_follow" class="btn btn-success" style="border-radius: 20px; width: 100px; color: #03B876">Follow</button>
                                @endif

                                    <script>
                                        $(document).ready(function() {
                                            $('#btn_follow').on('click', function() {
                                                $.post('{{ url('follow/'.$member->id) }}', {
                                                        _token: '{{ csrf_token() }}'
                                                    },
                                                    function(data, status) {
                                                        if (status) {
                                                            location.reload();
                                                        }
                                                    });
                                            });

                                            $('#btn_unfollow').on('click', function() {
                                                $.post('{{ url('unfollow/'.$member->id) }}', {
                                                        _token: '{{ csrf_token() }}'
                                                    },
                                                    function(data, status) {
                                                        if (status) {
                                                            location.reload();
                                                        }
                                                    });
                                            });
                                        });
                                    </script>

                            @endif

                        @endif
                    </div>
                </div>

                <form action="{{ url('profile/update_describe') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    {!! $profile->describe_profile !!}
                                </div>
                            </div>
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
                                            @if (Storage::has('profile_images/'.$story->member_id))
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_images/'.$story->member_id)) }}" style="width: 50px; heigth: 50px;" class="img-circle" alt=""></a>
                                            @else
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt=""></a>
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
                                    @if (Storage::has('story_pictures/'.$story->id))
                                        <a href="{{ url('/story/'.$story->id) }}"><img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('story_pictures/'.$story->id)) }}" alt="" class="img-responsive"></a>
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

                                    <a href="#" id="btn_like_story_{{ $story->id }}" class="font-color-blue">
                                        <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                        <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                                    </a>

                                    <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px;">{{ number_format($count->count_view) }}</span>

                                    <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px;">{{ count($comment) }}</span>

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