@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    @foreach ($storys as $story)

        @php
            $member = \App\Member::find($story->member_id);
            $comment = \App\Comment::where('story_id', $story->id)->get();
            $count = \App\StoryCount::find($story->id);
        @endphp

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">

                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px; padding-bottom: 10px;">
                        <div class="form-group text-right">
                            <a href="#" style="color: red !important;"><i class="fa fa-trash-o"></i> Delete</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-inline">
                                <div class="form-group" style="margin-top: 20px;">
                                    @if (file_exists(public_path('uploads/profile_images/'.$story->member_id)))
                                        <img src="{{ url('uploads/profile_images/'.$story->member_id) }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                    @else
                                        <img src="{{ url('images/icons/user.png') }}" style="width: 50px; height: 50px;" class="img-circle" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-blue">{{ $member->username }}<br>
                                        <span style="margin-left: 10px; font-size: 14px !important;" class="font-color-gray">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px; padding-bottom: 10px;">
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
                                {{--<button type="button" class="btn btn-bg-white btn-info btn-remove-hover" style="border-radius: 20px; color: dodgerblue"><i class="fa fa-thumbs-o-up"></i> <span style="color: dodgerblue">20,000</span></button>--}}

                                <a href="#" id="btn_like_story_{{ $story->id }}" class="font-color-blue" style="font-size: 16px !important;">
                                    <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                    <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                                </a>

                                <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ number_format($count->count_view) }}</span>

                                <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px; font-size: 16px;"></i>
                                <span style="color: #a6a6a6; //margin-left: 10px; font-size: 16px;">{{ count($comment) }}</span>

                                {{--<a href="#"><span class="font-color-gray pull-right"><i class="fa fa-bookmark font-color-blue"></i></span></a>--}}

                            </div>
                            <div class="form-group text-right">
                                <a href="{{ url('update_story/'.$story->id) }}"><button type="button" class="btn btn-bg-green border-green" style="width: 130px;"><i class="fa fa-pencil"></i> Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endforeach

@endsection