@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="padding-top: 20px;">

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
                            <button type="button" id="btn_unfollow" class="btn btn-bg-white font-color-blue" style="border-radius: 20px; width: 100px; color: #03B876">Unfollow</button>
                        @else
                            <button type="button" id="btn_follow" class="btn btn-bg-white font-color-blue" style="border-radius: 20px; width: 100px; color: #03B876">Follow</button>
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
                    $story = \App\Story::find($nearby_tag->story_id);
                    $member = \App\Member::find($story->member_id);
                    $comment = \App\Comment::where('story_id', $story->id)->get();
                    $count = \App\StoryCount::find($story->id);
                @endphp
                <!-- Article -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">

                        <div class="col-xs-12 col-sm-12 col-md-4 col-fulid">
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
                        <div class="col-xs-12 col-sm-12 col-md-12 col-fulid" style="margin-top: 20px; padding-bottom: 10px;">
                            <div class="form-group">
                                @if (Storage::has('story_pictures/'.$story->id))
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('story_pictures/'.$story->id)) }}" alt="" class="img-responsive"></a>
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

                                <a href="#"><span class="font-color-gray pull-right"><i class="fa fa-bookmark-o"></i></span></a>
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