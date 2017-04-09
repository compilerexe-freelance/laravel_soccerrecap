@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="padding-top: 20px;">

        @php
            // Pin Tag
            $pin_tag = \App\StickTagFeed::find($tag->id);
        @endphp

        @if ($pin_tag)

            @php
                $story = \App\Story::find($pin_tag->story_id);
            @endphp

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;"><i class="fa fa-star" style="color: #eddd45;"></i> {{ $story->story_title }} <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span></h3></a>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        <div class="form-group text-right">
            <span class="font-color-green pull-left" style="font-size: 16px;">{{ $current_sort }}</span>

            @if ($current_sort == "Current sort by latest")
                <a href="{{ url('tag/sort/like/'.$tag->id) }}">
                    <button type="button" class="btn btn-bg-white font-color-green border-green">
                        Sort by like
                    </button>
                </a>
            @else
                <a href="{{ url('tag/'.$tag->id) }}">
                    <button type="button" class="btn btn-bg-white font-color-green border-green">
                        Sort by latest
                    </button>
                </a>
            @endif

        </div>

        <div class="form-group">
            <span class="font-color-gray" style="font-size: 12px;">TAGGED IN</span>
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
                            <button type="button" id="btn_unfollow" class="btn btn-bg-green border-green" style="border-radius: 20px; width: 100px; color: #03B876">Unfollow</button>
                        @else
                            <button type="button" id="btn_follow" class="btn btn-bg-green border-green" style="border-radius: 20px; width: 100px; color: #03B876">Follow</button>
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">
                <hr style="margin: 0px">
            </div>

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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">

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
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}<br>
                                        <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="margin-top: 20px; padding-bottom: 10px;">
                            <div class="form-group">
                                @if (file_exists(public_path('uploads/story_pictures/'.$story->id)))
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive"></a>
                                @endif
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;">{{ $story->story_title }}</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">{!! str_limit($story->story_detail, 100) !!}</span>
                            </div>
                            <div class="form-group">
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

                                @if (Auth::check())
                                    @php
                                        $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story->id)->first();
                                    @endphp
                                    @if ($bookmark)
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right font-color-green"><i class="fa fa-bookmark"></i></span></a>
                                    @else
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right"><i class="fa fa-bookmark-o"></i></span></a>
                                    @endif
                                @endif

                            </div>
                            <hr>
                        </div>

                    </div>
                    <!-- End Article -->
            @endforeach

        </div>

    </div>

    <!--        <div class="col-xs-12 col-sm-12 col-md-4" style="background-color: #FAFAFA; padding-top: 20px;">-->
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
                    <span style="padding-left: 10px; line-height: 35px;">How to make your feeling happy!</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Compiler Exe</span>
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
                    <span style="padding-left: 10px; line-height: 35px;">3 Tips you need to know before travel!</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Compiler Exe</span>
                    <hr style="border-color: #f2f2f2">
                </div>
            </div>
        </div>

    </div>

@endsection