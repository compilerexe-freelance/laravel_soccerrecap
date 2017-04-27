@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="//margin-top: 20px;">

        @php
            $arr_storys = array();
        @endphp

        @foreach ($follows_tags as $follows_tag)

            @php
                $get_tag = \App\Tag::find($follows_tag->follow_tag_id);
                $fillter_tags = \App\Tag::where('tag_name', $get_tag->tag_name)->get();
            @endphp

            @foreach ($fillter_tags as $fillter_tag)

                @php
                    $storys = \App\Story::where('id', $fillter_tag->story_id)->orderBy('created_at', 'desc')->get();

                    foreach ($storys as $story) {

                        $data['id'] = $story->id;
                        $data['member_id'] = $story->member_id;
                        $data['story_title'] = $story->story_title;
                        $data['story_detail'] = $story->story_detail;
                        $data['created_at'] = $story->created_at;
                        $data['updated_at'] = $story->updated_at;

                        array_push($arr_storys, $data);

                    }

                @endphp

            @endforeach

        @endforeach

        @php
            $arrays = array_reverse(array_sort($arr_storys, function ($value) {
                return $value['created_at'];
            }));

        @endphp

        @foreach ($arrays as $story)

            @php
                $member = \App\Member::find($story['member_id']);
                $comment = \App\Comment::where('story_id', $story['id'])->get();
                $count = \App\StoryCount::find($story['id']);
            @endphp

            <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group" style="//border: 1px solid red;">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-fulid">
                                    <div class="form-inline">
                                        <div class="form-group" style="margin-top: 20px;">
                                            @if (file_exists(public_path('uploads/profile_images/'.$story['member_id'])))
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('uploads/profile_images/'.$story['member_id']) }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                            @else
                                                <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                    <span for="" style="margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                        <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story['created_at'])->toFormattedDateString() }}</span>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="//margin-top: 20px; padding-bottom: 10px;">

                                    @if (file_exists(public_path('uploads/story_pictures/'.$story['id'])))
                                        <div class="form-group" style="margin-top: 20px !important;">
                                            <a href="{{ url('/story/'.$story['id']) }}"><img src="{{ url('uploads/story_pictures/'.$story['id']) }}" alt="" class="img-responsive"></a>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <a href="{{ url('/story/'.$story['id']) }}"><h3 style="font-weight: bold;">{{ $story['story_title'] }}</h3></a>
                                    </div>
                                    <div class="form-group">
                                        <span style="font-size: 18px;">
                                            @php
                                                $story_detail = strip_tags($story['story_detail'], "<p>");
                                            @endphp
                                                {!!  str_limit($story_detail, 200) !!}
                                        </span>
                                    </div>

                                    <div class="form-group">

                                        <a href="#" id="btn_like_story_{{ $story['id'] }}" class="font-color-blue" style="font-size: 16px !important;">
                                            <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                            <span style="color: dodgerblue" id="story_{{ $story['id'] }}_like">{{ number_format($count->count_like) }}</span>
                                        </a>

                                        <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                        <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ number_format($count->count_view) }}</span>

                                        <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                        <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ count($comment) }}</span>

                                        @if (Auth::check())
                                            @php
                                                $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story['id'])->first();
                                            @endphp
                                            @if ($bookmark)
                                                <a href="{{ url('bookmark/'.$story['id']) }}"><span class="font-color-gray pull-right font-color-blue">@lang('messages.bookmark_confirm') <i class="fa fa-bookmark"></i></span></a>
                                            @else
                                                <a href="{{ url('bookmark/'.$story['id']) }}"><span class="font-color-gray pull-right">@lang('messages.bookmark_cancel') <i class="fa fa-bookmark-o"></i></span></a>
                                            @endif
                                        @endif

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @if (Auth::check())
                    <script>
                        $(document).ready(function() {
                            $('#btn_like_story_{{ $story['id'] }}').on('click', function() {
                                $.post('{{ url('like_story/'.$story['id'].'/'.Auth::user()->id) }}', {
                                        _token: '{{ csrf_token() }}',
                                        story_id: '{{ $story['id'] }}',
                                        member_id: '{{ Auth::user()->id }}'
                                    },
                                    function(data, status) {
                                        if (status) {
                                            $('#story_{{ $story['id'] }}_like').text(data);
                                        }
                                    });
                            });
                        });
                    </script>
                @endif

            </div>

        @endforeach

    </div>

    @include('layouts.components.sidebar_right')

@endsection