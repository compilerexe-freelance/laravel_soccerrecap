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



                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;"><i class="fa fa-star" style="color: #eddd45;"></i> {{ $story->story_title }} <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span></h3></a>
                        </div>
                    </div>


        @endif

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
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
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
                            <hr>
                        </div>

                    </div>
                    <!-- End Article -->
            @endforeach

        </div>

    </div>

    <!--        <div class="col-xs-12 col-sm-12 col-md-4" style="background-color: #FAFAFA; padding-top: 20px;">-->
    <div class="col-xs-12 col-sm-12 col-md-5" style="background-color: #FAFAFA; padding-top: 20px;">

        {{--Live score--}}
        @php

            // Premier League

            /* League 178 */
            $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=178');
            $obj = json_decode($json);

            $livescore_league_178 = array();

            if (count($obj->data->match) >= 1) {
                foreach ($obj->data->match as $key => $value) {
                    $buffer = array();
                    array_push($buffer, $value->home_name);
                    array_push($buffer, $value->away_name);
                    array_push($buffer, $value->score);
                    array_push($buffer, $value->time);

                    array_push($livescore_league_178, $buffer);
                }
            }
            /* End League 178 */

            /* League 179 */
            $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=179');
            $obj = json_decode($json);

            $livescore_league_179 = array();

            if (count($obj->data->match) >= 1) {
                foreach ($obj->data->match as $key => $value) {
                    $buffer = array();
                    array_push($buffer, $value->home_name);
                    array_push($buffer, $value->away_name);
                    array_push($buffer, $value->score);
                    array_push($buffer, $value->time);

                    array_push($livescore_league_179, $buffer);
                }
            }
            /* End League 179 */

            /* Country 19 */
            $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&country=19');
            $obj = json_decode($json);

            $livescore_country_19 = array();

            if (count($obj->data->match) >= 1) {
                foreach ($obj->data->match as $key => $value) {
                    $buffer = array();
                    array_push($buffer, $value->home_name);
                    array_push($buffer, $value->away_name);
                    array_push($buffer, $value->score);
                    array_push($buffer, $value->time);

                    array_push($livescore_country_19, $buffer);
                }
            }
            /* End Country 19 */

            /* Country 27 */
            $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&country=27');
            $obj = json_decode($json);

            $livescore_country_27 = array();

            if (count($obj->data->match) >= 1) {
                foreach ($obj->data->match as $key => $value) {
                    $buffer = array();
                    array_push($buffer, $value->home_name);
                    array_push($buffer, $value->away_name);
                    array_push($buffer, $value->score);
                    array_push($buffer, $value->time);

                    array_push($livescore_country_27, $buffer);
                }
            }
            /* End Country 27 */

        // End Premier League

        @endphp


        {{--End Live score--}}



        @php
            $tags = \App\Tag::orderByRaw('RAND()')->limit(20)->get();

            // Contact
            $contact_title = "";
            $contact_detail = "";
            $check_contact = \App\Contact::find(1);
            if ($check_contact) {
                $contact_title = $check_contact->contact_title;
                $contact_detail = $check_contact->contact_detail;
            }
        @endphp

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="//margin-top: 20px;">
                <b>@lang('messages.feature_tag')</b>
            </div>
            <div class="form-group">

                @foreach ($tags as $tag)
                    <a href="{{ url('tag/'.$tag->id) }}"><button type="button" class="btn btn-default btn-remove-hover btn-tag">{{ $tag->tag_name }}</button></a>
                @endforeach

            </div>
            <hr style="border-color: #ffffff">
        </div>

    @php
        $editor_pick = \App\EditorPick::find(1);
    @endphp

    @if ($editor_pick)

        @php

            if ($editor_pick->story_id_1 != null) {
                $editor_pick_1 = \App\Story::find($editor_pick->story_id_1);
                $member_editor_1 = \App\Member::find($editor_pick_1->member_id);
            }

            if ($editor_pick->story_id_2 != null) {
                $editor_pick_2 = \App\Story::find($editor_pick->story_id_2);
                $member_editor_2 = \App\Member::find($editor_pick_2->member_id);
            }

            if ($editor_pick->story_id_3 != null) {
                $editor_pick_3 = \App\Story::find($editor_pick->story_id_3);
                $member_editor_3 = \App\Member::find($editor_pick_3->member_id);
            }

            if ($editor_pick->story_id_4 != null) {
                $editor_pick_4 = \App\Story::find($editor_pick->story_id_4);
                $member_editor_4 = \App\Member::find($editor_pick_4->member_id);
            }

            if ($editor_pick->story_id_5 != null) {
                $editor_pick_5 = \App\Story::find($editor_pick->story_id_5);
                $member_editor_5 = \App\Member::find($editor_pick_5->member_id);
            }

        @endphp

        <!-- Editor's pick -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <b>@lang('messages.editor_pick')</b>
                </div>

                @if ($editor_pick->story_id_1 != null)
                    <div class="form-group">
                        <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                            <div class="text-cycle">
                                <span>1</span>
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-11">
                            <a href="{{ url('/story/'.$editor_pick->story_id_1) }}"><span style="padding-left: 10px; line-height: 35px;">{{ $editor_pick_1->story_title }}</span></a><br>
                            <span style="padding-left: 10px;" class="font-color-gray">{{ $member_editor_1->username }}</span>
                            <hr style="border-color: #f2f2f2">
                        </div>
                    </div>
                @endif

                @if ($editor_pick->story_id_2 != null)
                    <div class="form-group">
                        <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                            <div class="text-cycle">
                                <span>2</span>
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-11">
                            <a href="{{ url('/story/'.$editor_pick->story_id_2) }}"><span style="padding-left: 10px; line-height: 35px;">{{ $editor_pick_2->story_title }}</span></a><br>
                            <span style="padding-left: 10px;" class="font-color-gray">{{ $member_editor_2->username }}</span>
                            <hr style="border-color: #f2f2f2">
                        </div>
                    </div>
                @endif

                @if ($editor_pick->story_id_3 != null)
                    <div class="form-group">
                        <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                            <div class="text-cycle">
                                <span>3</span>
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-11">
                            <a href="{{ url('/story/'.$editor_pick->story_id_3) }}"><span style="padding-left: 10px; line-height: 35px;">{{ $editor_pick_3->story_title }}</span></a><br>
                            <span style="padding-left: 10px;" class="font-color-gray">{{ $member_editor_3->username }}</span>
                            <hr style="border-color: #f2f2f2">
                        </div>
                    </div>
                @endif

                @if ($editor_pick->story_id_4 != null)
                    <div class="form-group">
                        <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                            <div class="text-cycle">
                                <span>4</span>
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-11">
                            <a href="{{ url('/story/'.$editor_pick->story_id_4) }}"><span style="padding-left: 10px; line-height: 35px;">{{ $editor_pick_4->story_title }}</span></a><br>
                            <span style="padding-left: 10px;" class="font-color-gray">{{ $member_editor_4->username }}</span>
                            <hr style="border-color: #f2f2f2">
                        </div>
                    </div>
                @endif

                @if ($editor_pick->story_id_5 != null)
                    <div class="form-group">
                        <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                            <div class="text-cycle">
                                <span>5</span>
                            </div>
                        </div>
                        <div class="col-xs-11 col-sm-12 col-md-11">
                            <a href="{{ url('/story/'.$editor_pick->story_id_5) }}"><span style="padding-left: 10px; line-height: 35px;">{{ $editor_pick_5->story_title }}</span></a><br>
                            <span style="padding-left: 10px;" class="font-color-gray">{{ $member_editor_5->username }}</span>
                            <hr style="border-color: #f2f2f2">
                        </div>
                    </div>
                @endif

            </div>
    @else
        <!-- Editor's pick -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <b>@lang('messages.editor_pick')</b>
                </div>
            </div>
    @endif

    <!-- Contact -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <span><b>@lang('messages.contact')</b></span>
            </div>
            <div class="form-group">
                <a href="{{ url('contact') }}">{{ $contact_title }}</a>
            </div>
            <hr>
        </div>

        <!-- Live score -->
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">
                <span style="font-weight: bold;">@lang('messages.text_live_score')</span>
            </div>

            @foreach ($livescore_country_19 as $data)
                <div class="form-group text-center">
                    <span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>
                    <span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>
                </div>
            @endforeach

            @foreach ($livescore_country_27 as $data)
                <div class="form-group text-center">
                    <span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>
                    <span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>
                </div>
            @endforeach

            @foreach ($livescore_league_178 as $data)
                <div class="form-group text-center">
                    <span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>
                    <span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>
                </div>
            @endforeach

            @foreach ($livescore_league_179 as $data)
                <div class="form-group text-center">
                    <span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>
                    <span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>
                </div>
            @endforeach

        </div>

    </div>

@endsection