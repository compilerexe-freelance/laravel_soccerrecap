@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-7" style="padding-top: 20px;">

        @for ($i = 0; $i <= 11; $i++)
            @foreach ($list_month[$i] as $month)

                @php
                    $story = \App\Story::find($month);
                    $month = \Carbon\Carbon::parse($story->created_at)->month;
                    $member = \App\Member::find($story->member_id);
                    $comment = \App\Comment::where('story_id', $story->id)->get();
                    $count = \App\StoryCount::find($story->id);
                @endphp

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="form-group text-right">
                            <span style="font-size: 24px;" class="font-color-gray">
                                {{ date("F", mktime(0, 0, 0, $month, 1)) }}
                            </span>
                        </div>

                        <div class="form-group" style="//border: 1px solid red;">

                            {{----}}
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
                                        <span for="" style="font-size: 16px; margin-left: 10px;" class="font-color-green">{{ $member->username }}<br>
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
                                    <span style="font-size: 18px;">{!! str_limit($story->story_detail, 100) !!}</span>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="btn_like_story_{{ $story->id }}" class="font-color-blue">
                                        <i class="fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
                                        <span style="color: dodgerblue" id="story_{{ $story->id }}_like">{{ number_format($count->count_like) }}</span>
                                    </a>

                                    <i class="fa fa-eye" style="margin-left: 10px; margin-right: 10px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px;">{{ number_format($count->count_view) }}</span>

                                    <i class="fa fa-comment-o" style="margin-left: 10px; margin-right: 10px;"></i>
                                    <span style="color: #a6a6a6; //margin-left: 10px;">{{ count($comment) }}</span>

                                    @php
                                        $bookmark = \App\Bookmark::where('member_id', Auth::user()->id)->where('story_id', $story->id)->first();
                                    @endphp
                                    @if ($bookmark)
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right font-color-green"><i class="fa fa-bookmark"></i></span></a>
                                    @else
                                        <a href="{{ url('bookmark/'.$story->id) }}"><span class="font-color-gray pull-right"><i class="fa fa-bookmark-o"></i></span></a>
                                    @endif

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
                            {{----}}

                        </div>
                    </div>
                </div>
            @endforeach
        @endfor

    </div>

    <div class="col-xs-12 col-sm-12 col-md-5" style="padding-top: 20px; margin-bottom: 20px; //border: 1px solid red; //background-color: #f2f2f2">

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
                <small><b>FEATURED TAGS</b></small>
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
                        <small><b>EDITOR'S PICK</b></small>
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
                        <small><b>EDITOR'S PICK</b></small>
                    </div>
                </div>
        @endif

        <!-- Contact -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <span><b>Contact</b></span>
            </div>
            <div class="form-group">
                <a href="{{ url('contact') }}">{{ $contact_title }}</a>
            </div>
        </div>

    </div>

@endsection