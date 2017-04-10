@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 20px;">
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                    <!-- Header -->
                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px !important; padding-right: 0px !important;">
                        <div class="col-xs-7 col-sm-12 col-md-4">
                            <div class="form-group" style="margin-top: 20px;">
                                @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                    <img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                @else
                                    <img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                @endif
                                <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}</span>
                            </div>
                            <div class="form-group">
                                <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-12 col-md-8">
                            <div class="form-group text-right" style="margin-top: 20px;">
                                {{--<button type="button" class="btn btn-bg-blue border-blue" style="//background-color: #03B876 !important;"><i class="fa fa-facebook"></i> SHARE</button>--}}
                                <div class="fb-share-button" data-href="{{ url('story/'.$story->id) }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdebugcode.esy.es%2Fstory%2F8&amp;src=sdkpreparse">Share</a></div>


                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=280954535688085";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>

                            </div>
                        </div>
                    </div>

                    <!-- Article Image -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            @if (Storage::has('story_pictures/'.$story->id))
                                <img src="{{ url('uploads/story_pictures/'.$story->id) }}" alt="" class="img-responsive">
                            @endif
                        </div>
                    </div>

                    <!-- Article Detail -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <span style="font-size: 30px;"><b>{{ $story->story_title }}</b></span>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 20px;" class="font-color-gray">{!! $story->story_detail !!}</span>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-tags"></i>
                            @foreach ($tags as $tag)
                                <span>{{ $tag->tag_name }}</span>
                                @if (!$loop->last)
                                    <span>,</span>
                                @endif
                            @endforeach
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

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">{{ number_format($count->count_view) }}</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">{{ count($comments) }}</span>

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
                        <div class="form-group">
                            <hr>
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

                    <!-- Author Icon -->
                        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px !important; padding-right: 0px !important;">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 text-center" style="//border: 1px solid red">
                                <div class="form-group" style="//margin-top: 20px;">
                                    @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                        <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                    @else
                                        <a href="{{ url('profile/user/'.$member->id) }}"><img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" class="img-circle" alt=""></a>
                                    @endif
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}</span>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 14px; font-weight: normal; //margin-left: 94px;" class="font-color-gray">{{ $profile->describe_profile }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-2 text-center" style="//border: 1px solid red">

                                @if (Auth::check())
                                    <div class="form-group" style="//margin-top: 25px;">
                                        @php
                                            $follow_check = \App\FollowsMember::where('member_id', Auth::user()->id)
                                            ->where('follow_member_id', $member->id)
                                            ->first();
                                        @endphp

                                        @if ($member->id != Auth::user()->id)

                                            @if ($follow_check)
                                                <button type="button" id="btn_unfollow" class="btn btn-bg-green border-green" style="border-radius: 20px; width: 100px; color: #03B876">Unfollow</button>
                                            @else
                                                <button type="button" id="btn_follow" class="btn btn-bg-green border-green" style="border-radius: 20px; width: 100px; color: #03B876">Follow</button>
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
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    @foreach ($unique_tag_ids as $unique_tag_id)

        @php
            $story_suggest = \App\Story::find($unique_tag_id);
            $comment = \App\Comment::where('story_id', $story_suggest->id)->get();
        @endphp

        <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; //padding-left: 0px !important; //padding-right: 0px !important;">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="form-group">
                        <div class="form-inline">
                            <div class="form-group" style="margin-top: 10px;">
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

                    <div class="form-group">
                        <a href="#"><h3>{{ $story_suggest->story_title }}</h3></a>
                    </div>
                    <div class="form-group">
                        <span style="font-size: 18px;">{!! str_limit($story_suggest->story_detail, 100) !!}</span>
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

    @endforeach

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                @if (Auth::check())

                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <span style="font-size: 14px; font-weight: bold;">RESPONSES</span>
                        </div>
                        <form action="{{ url('posts/comment/'.$story->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <!-- Header -->
                            <div class="form-group" style="margin-top: 20px;">
                                @if (file_exists(public_path('uploads/profile_images/'.Auth::user()->id)))
                                    <img src="{{ url('uploads/profile_images/'.Auth::user()->id) }}"
                                         style="width: 50px; height: 50px;"
                                         class="img-circle"
                                         alt="">
                                @else
                                    <img src="{{ url('images/icons/user.png') }}"
                                         style="width: 50px !important; height: 50px !important;"
                                         class="img-circle"
                                         alt="">
                                @endif
                                <span for="" style="margin-left: 10px;" class="font-color-green">{{ Auth::user()->username }}</span>
                            </div>
                            <div class="form-group">
                                <textarea name="comment_detail" id="summernote"></textarea>
                            </div>
                            <div class="form-group text-right" style="margin-top: 20px;">
                                <button type="submit" id="btn_comment_submit" class="btn btn-bg-green border-green" style="background-color: #03B876 !important; font-size: 16px; width: 120px;" disabled>Post</button>
                                <button type="button" id="btn_comment_cancel" class="btn btn-bg-white border-green font-color-green" style="font-size: 16px; width: 120px;">Cancle</button>
                            </div>
                        </form>
                    </div>

                @endif

                @foreach ($comments as $comment)

                    @php
                        $member = \App\Member::find($comment->member_id);
                    @endphp

                    <div class="col-md-6 col-md-offset-3">
                        <!-- Header -->
                        <div class="form-group" style="margin-top: 20px;">
                            @if (file_exists(public_path('uploads/profile_images/'.$member->id)))
                                <img src="{{ url('uploads/profile_images/'.$member->id) }}"
                                     style="width: 50px !important; height: 50px !important;"
                                     class="img-circle"
                                     alt="">
                            @else
                                <img src="{{ url('images/icons/user.png') }}"
                                     style="width: 50px !important; height: 50px !important;"
                                     class="img-circle"
                                     alt="">
                            @endif
                            <span for="" style="margin-left: 10px;" class="font-color-green">{{ $member->username }} <span class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->toFormattedDateString() }}</span></span>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 18px;">{!! $comment->comment_detail !!}</span>
                        </div>
                        <hr>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#summernote').summernote({
                toolbar: false,
                height: 150,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });

            $('#btn_comment_cancel').on('click', function() {
                $('.note-editable').html(null);
            });

            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                if (contents.length == 11 || contents.length == 0) {
                    $('#btn_comment_submit').attr('disabled', true);
                } else {
                    $('#btn_comment_submit').attr('disabled', false);
                }
            });

        });
    </script>

@endsection