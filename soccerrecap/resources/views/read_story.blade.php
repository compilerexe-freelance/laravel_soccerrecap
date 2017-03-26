@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <!-- Header -->
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px !important; padding-right: 0px !important;">
                    <div class="col-xs-7 col-sm-12 col-md-4">
                        <div class="form-group" style="margin-top: 20px;">
                            @if (Storage::has('profile_images/'.$story->member_id))
                                <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_images/'.$story->member_id)) }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            @else
                                <img src="{{ url('images/icons/user.png') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            @endif
                            <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}</span>
                        </div>
                        <div class="form-group">
                            <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ $story->updated_at }}</span>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-12 col-md-8">
                        <div class="form-group text-right" style="margin-top: 20px;">
                            <button type="button" class="btn btn-success bg-success btn-remove-shadow" style="background-color: #03B876 !important;"><i class="fa fa-facebook"></i> SHARE</button>
                        </div>
                    </div>
                </div>

                <!-- Article Image -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        @if (Storage::has('story_pictures/'.$story->id))
                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('story_pictures/'.$story->id)) }}" alt="" class="img-responsive">
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
                        <button type="button" id="btn_like_story_{{ $story->id }}" class="btn btn-info btn-remove-hover" style="width: 120px; border-radius: 20px; color: dodgerblue">
                            <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                            <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                        </button>

                        <i class="fa fa-eye" style="margin-left: 10px;"></i>
                        <span style="color: #a6a6a6; //margin-left: 10px;">{{ number_format($count->count_view) }}</span>

                        <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                        <span style="color: #a6a6a6; //margin-left: 10px;">{{ count($comments) }}</span>

                        <a href="#"><span class="font-color-gray pull-right"><i class="fa fa-bookmark-o"></i></span></a>
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
                                <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                                <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}</span>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 14px; font-weight: normal; //margin-left: 94px;" class="font-color-gray">{{ $profile->describe_profile }}</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-2 text-center" style="//border: 1px solid red">
                            <div class="form-group" style="//margin-top: 25px;">
                                <button type="button" class="btn btn-success btn-remove-shadow" style="border-radius: 20px; width: 100%; color: #03B876">Follow</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; padding-left: 0px !important; //padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's HTML</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; //padding-left: 0px !important; //padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's CSS</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="//border: 1px solid #abc; //padding-left: 0px !important; padding-right: 0px !important;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <a href="#"><h3>What's PHP</h3></a>
                </div>
                <div class="form-group">
                    <span style="font-size: 18px;" class="font-color-gray">Hello world! This is a test!!!</span>
                </div>
                <div class="form-group" style="margin-top: 20px; padding-bottom: 50px;">

                    <div class="form-inline">
                        <div class="form-group pull-left">
                            <img src="{{ url('images/icons/me.jpg') }}" style="width: 50px; heigth: 50px;" class="img-circle" alt="">
                            <span for="" style="margin-left: 10px;" class="font-color-green">Macbook Pro</span>
                        </div>
                        <div class="form-group pull-right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">1,000</span></button>

                            <i class="fa fa-eye" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">2,000</span>

                            <i class="fa fa-comment-o" style="margin-left: 10px;"></i>
                            <span style="color: #a6a6a6; //margin-left: 10px;">5,000</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-fulid">
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
                                @if (Storage::has('profile_images/'.Auth::user()->id))
                                    <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_images/'.Auth::user()->id)) }}"
                                         style="width: 50px !important; height: 50px !important;"
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
                                <button type="submit" id="btn_comment_submit" class="btn btn-success bg-success" style="background-color: #03B876 !important; font-size: 16px; width: 120px;" disabled>Publish</button>
                                <button type="button" id="btn_comment_cancel" class="btn btn-success bg-success font-color-green" style="font-size: 16px; width: 120px;">Cancle</button>
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
                            @if (Storage::has('profile_images/'.$member->id))
                                <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('profile_images/'.$member->id)) }}"
                                     style="width: 50px !important; height: 50px !important;"
                                     class="img-circle"
                                     alt="">
                            @else
                                <img src="{{ url('images/icons/user.png') }}"
                                     style="width: 50px !important; height: 50px !important;"
                                     class="img-circle"
                                     alt="">
                            @endif
                            <span for="" style="margin-left: 10px;" class="font-color-green">{{ $member->username }} <span class="font-color-gray pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans() }}</span></span>
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