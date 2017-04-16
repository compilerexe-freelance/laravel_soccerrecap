@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="//padding-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group text-right">


                    @if ($current_sort == "Current sort by latest")
                        <span class="font-color-blue pull-left" style="font-size: 16px;">@lang('messages.current_sort_like')</span>
                        <a href="{{ url('tag/sort/like/'.$tag->id) }}">
                            <button type="button" class="btn btn-bg-white font-color-blue border-blue">
                                @lang('messages.sort_by_latest')
                            </button>
                        </a>
                    @else
                        <span class="font-color-blue pull-left" style="font-size: 16px;">@lang('messages.current_sort_latest')</span>
                        <a href="{{ url('tag/'.$tag->id) }}">
                            <button type="button" class="btn btn-bg-white font-color-blue border-blue">
                                @lang('messages.sort_by_like')
                            </button>
                        </a>
                    @endif

                </div>

                <div class="form-group">
                    <span class="font-color-gray" style="font-size: 14px;">@lang('messages.tagged_in')</span>
                </div>
                <div class="form-group" style="//border: 1px solid red;">

                    <div class="col-xs-12 col-sm-12 col-md-10 text-left col-fulid">
                        <div class="form-group" style="//margin-top: 20px;">
                            <span style="font-size: 26px">{{ $tag->tag_name }}</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 text-right col-fulid">
                        <div class="form-group" style="//margin-top: 25px;">

                            @if (Auth::check())

                                @php
                                    $follow_check = \App\FollowsTag::where('member_id', Auth::user()->id)
                                    ->where('follow_tag_id', $tag->id)
                                    ->first();
                                @endphp

                                @if ($follow_check)
                                    <button type="button" id="btn_unfollow" class="btn btn-bg-blue border-blue" style="border-radius: 20px; width: 100px; color: #03B876">@lang('messages.unfollow')</button>
                                @else
                                    <button type="button" id="btn_follow" class="btn btn-bg-blue border-blue" style="border-radius: 20px; width: 100px; color: #03B876">@lang('messages.follow')</button>
                                @endif

                                <script>
                                    $(document).ready(function() {
                                        $('#btn_follow').on('click', function() {
                                            $.post('{{ url('tag/follow/'.$tag->id) }}', {
                                                    _token: '{{ csrf_token() }}'
                                                },
                                                function(data, status) {
                                                    if (status) {
                                                        location.reload();
                                                    }
                                                });
                                        });

                                        $('#btn_unfollow').on('click', function() {
                                            $.post('{{ url('tag/unfollow/'.$tag->id) }}', {
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

                        </div>
                    </div>
            </div>
        </div>
            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-fulid">--}}
                {{--<hr style="margin: 0px">--}}
            {{--</div>--}}

            @foreach ($nearby_tags as $nearby_tag)
                @php
                    if ($current_sort == "Current sort by like") {
                        $story_count = \App\StoryCount::orderBy('count_like')->where('story_id', $nearby_tag->story_id)->first();
                        $story = \App\Story::find($story_count->story_id);
                    } else {
                        $story = \App\Story::find($nearby_tag->story_id);
                    }
                    $member = \App\Member::find($story->member_id);
                    $comment = \App\Comment::where('story_id', $story->id)->get();
                    $count = \App\StoryCount::find($story->id);
                @endphp
                <!-- Article -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="margin-top: 10px;">

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-fulid">
                                    <div class="form-inline">
                                        <div class="form-group" style="margin-top: 20px;">
                                            @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                            @else
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                        <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="margin-top: 10px; //padding-bottom: 10px;">
                                    <div class="form-group">
                                        @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                            <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                        @endif
                                    </div>
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
                                    {{--<hr>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Article -->
            @endforeach

        </div>

    </div>

    @include('layouts.components.sidebar_right')

@endsection