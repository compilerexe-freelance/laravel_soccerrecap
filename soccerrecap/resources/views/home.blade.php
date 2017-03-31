@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="padding-top: 20px; //background-color: #ffffff; //border: 1px solid #cccccc; margin-bottom: 20px;">

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
                        <div class="col-xs-12 col-sm-12 col-md-12" style="//margin-top: 20px; padding-bottom: 10px;">

                            @if (Storage::has('story_pictures/'.$story->id))
                                <div class="form-group" style="margin-top: 20px !important;">
                                    <a href="{{ url('/story/'.$story->id) }}"><img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('story_pictures/'.$story->id)) }}" alt="" class="img-responsive"></a>
                                </div>
                            @endif

                            <div class="form-group">
                                <a href="{{ url('/story/'.$story->id) }}"><h3 style="font-weight: bold;">{{ $story->story_title }}</h3></a>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 18px;">{!! str_limit($story->story_detail, 100) !!}</span>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btn_like_story_{{ $story->id }}" class="btn btn-info btn-remove-hover" style="width: 120px; border-radius: 20px; color: dodgerblue">
                                    <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                    <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                                </button>

                                <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px;">{{ number_format($count->count_view) }}</span>

                                <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px;">{{ count($comment) }}</span>

                                <a href="#"><span class="font-color-gray pull-right"><i class="fa fa-bookmark-o"></i></span></a>
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
    <div class="col-xs-12 col-sm-12 col-md-5" style="padding-top: 20px; margin-bottom: 20px; //border: 1px solid red; //background-color: #f2f2f2">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="//margin-top: 20px;">
                <small><b>FEATURED TAGS</b></small>
            </div>
            <div class="form-group">

                @foreach ($tags as $tag)
                    <a href="{{ url('tag/'.$tag->id) }}"><button type="button" class="btn btn-default btn-remove-hover btn-tag">{{ $tag->tag_name }}</button></a>
                @endforeach

            </div>
            <hr style="border-color: #ffffff">
        </div>

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
                    <span style="padding-left: 10px; line-height: 35px;">How to become an entrepreneur!!</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Macbook Pro</span>
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
                    <span style="padding-left: 10px; line-height: 35px;">Intel 2017</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Tester</span>
                    <hr style="border-color: #f2f2f2">
                </div>
            </div>
        </div>

        <!-- Editor's pick -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <small><b>EDITOR'S PICK</b></small>
            </div>

            <div class="form-group">
                <div class="col-xs-1 col-sm-12 col-md-1 text-center">
                    <div class="text-cycle">
                        <span>1</span>
                    </div>
                </div>
                <div class="col-xs-11 col-sm-12 col-md-11">
                    <span style="padding-left: 10px; line-height: 35px;">How to become an entrepreneur!!</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Macbook Pro</span>
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
                    <span style="padding-left: 10px; line-height: 35px;">Intel 2017</span><br>
                    <span style="padding-left: 10px;" class="font-color-gray">Tester</span>
                    <hr style="border-color: #f2f2f2">
                </div>
            </div>
        </div>

    </div>

@endsection