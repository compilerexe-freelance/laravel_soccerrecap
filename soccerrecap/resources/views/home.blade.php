@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="//padding-top: 20px; //background-color: #ffffff; //border: 1px solid #cccccc; margin-bottom: 20px;">

        {{-- pin story --}}

        @if ($pin_story->story_id_1 != 0)
            <div class="panel panel-default">
                <div class="panel-body">

                    @if ($pin_story->story_id_1 != 0)
                        @php
                            $story = \App\Story::find($pin_story->story_id_1);
                        @endphp
                        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                            {{--<div class="form-group">--}}
                                {{--<a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;"><i class="fa fa-star" style="color: #eddd45;"></i> {{ $story->story_title }} <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span></h3></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        @php
                            $member = \App\Member::find($story->member_id);
                            $comment = \App\Comment::where('story_id', $story->id)->get();
                            $count = \App\StoryCount::find($story->id);
                        @endphp
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <i class="fa fa-star pull-right" style="font-size: 26px; color: #eddd45;"></i>
                            <div class="form-inline">
                                <div class="form-group" style="margin-top: 20px;">
                                    @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                        <a href="{{ url('profile/user/'.$member->id) }}">
                                            <img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                        </a>
                                    @else
                                        <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" lass="img-circle" alt=""></a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                    <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="//margin-top: 20px; padding-bottom: 10px;">

                            @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                <div class="form-group" style="margin-top: 20px !important;">
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                </div>
                            @endif

                            <div class="form-group">
                                <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;">{{ $story->story_title }}</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">
                                    @php
                                        $story_detail = strip_tags($story->story_detail, "<p>");
                                    @endphp
                                    {!!  str_limit($story_detail, 200) !!}
                                </span>
                            </div>
                            <div class="form-group">
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

                                @if (Auth::check())
                                    @php
                                        $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story->id)->first();
                                    @endphp
                                    @if ($bookmark)
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right font-color-blue">@lang('messages.bookmark_confirm') <i class="fa fa-bookmark"></i></span></a>
                                    @else
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right">@lang('messages.bookmark_cancel') <i class="fa fa-bookmark-o"></i></span></a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        @endif

        @if ($pin_story->story_id_2 != 0)
            <div class="panel panel-default">
                <div class="panel-body">

                    @if ($pin_story->story_id_2 != 0)
                        @php
                            $story = \App\Story::find($pin_story->story_id_2);
                        @endphp
                        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                        {{--<a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;"><i class="fa fa-star" style="color: #eddd45;"></i> {{ $story->story_title }} <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span></h3></a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        @php
                            $member = \App\Member::find($story->member_id);
                            $comment = \App\Comment::where('story_id', $story->id)->get();
                            $count = \App\StoryCount::find($story->id);
                        @endphp
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <i class="fa fa-star pull-right" style="font-size: 26px; color: #eddd45;"></i>
                            <div class="form-inline">
                                <div class="form-group" style="margin-top: 20px;">
                                    @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                        <a href="{{ url('profile/user/'.$member->id) }}">
                                            <img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                        </a>
                                    @else
                                        <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" lass="img-circle" alt=""></a>
                                    @endif
                                </div>
                                <div class="form-group">
                                <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="//margin-top: 20px; padding-bottom: 10px;">

                            @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                <div class="form-group" style="margin-top: 20px !important;">
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                </div>
                            @endif

                            <div class="form-group">
                                <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;">{{ $story->story_title }}</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">
                                    @php
                                        $story_detail = strip_tags($story->story_detail, "<p>");
                                    @endphp
                                    {!!  str_limit($story_detail, 200) !!}
                                </span>
                            </div>
                            <div class="form-group">
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

                                @if (Auth::check())
                                    @php
                                        $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story->id)->first();
                                    @endphp
                                    @if ($bookmark)
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right font-color-blue">@lang('messages.bookmark_confirm') <i class="fa fa-bookmark"></i></span></a>
                                    @else
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right">@lang('messages.bookmark_cancel') <i class="fa fa-bookmark-o"></i></span></a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    @endif

                    @if ($pin_story->story_id_2 != 0)
                        @php
                            $story = \App\Story::find($pin_story->story_id_2);
                        @endphp
                        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                        {{--<a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;"><i class="fa fa-star" style="color: #eddd45;"></i> {{ $story->story_title }} <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span></h3></a>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                    @endif

                </div>
            </div>
        @endif

        {{-- end pin story --}}

        @foreach ($storys as $story)

            @php
                $member = \App\Member::find($story->member_id);
                $comment = \App\Comment::where('story_id', $story->id)->get();
                $count = \App\StoryCount::find($story->id);
            @endphp

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-inline">
                                <div class="form-group" style="margin-top: 20px;">
                                    @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                        <a href="{{ url('profile/user/'.$member->id) }}">
                                            <img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                        </a>
                                    @else
                                        <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" lass="img-circle" alt=""></a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                    <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="//margin-top: 20px; padding-bottom: 10px;">

                            @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                <div class="form-group" style="margin-top: 20px !important;">
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                </div>
                            @endif

                            <div class="form-group">
                                <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;">{{ $story->story_title }}</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">
                                    @php
                                        $story_detail = strip_tags($story->story_detail, "<p>");
                                    @endphp
                                    {!!  str_limit($story_detail, 200) !!}
                                </span>
                            </div>
                            <div class="form-group">
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

                                @if (Auth::check())
                                    @php
                                        $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story->id)->first();
                                    @endphp
                                    @if ($bookmark)
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right font-color-blue">@lang('messages.bookmark_confirm') <i class="fa fa-bookmark"></i></span></a>
                                    @else
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right">@lang('messages.bookmark_cancel') <i class="fa fa-bookmark-o"></i></span></a>
                                    @endif
                                @endif

                            </div>
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

    @include('layouts.components.sidebar_right')

@endsection