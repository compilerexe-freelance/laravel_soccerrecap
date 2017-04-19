<div class="col-xs-12 col-sm-12 col-md-5" style="//padding-top: 20px; margin-bottom: 20px; //border: 1px solid red; //background-color: #f2f2f2">

    @php
        $tags = \App\Tag::groupBy('tag_name')->orderByRaw('RAND()')->limit(20)->get();

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
        <hr style="border-color: #000000">
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

    <div class="col-xs-12 col-sm-12 col-md-12">
        <hr style="border-color: #000000">
    </div>

    <!-- Contact -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <span><b>@lang('messages.contact')</b></span>
        </div>
        <div class="form-group">
            <a href="{{ url('contact') }}">{{ $contact_title }}</a>
        </div>
        <hr style="border-color: #000000">
    </div>

    <!-- Live score -->
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">
            <span style="font-weight: bold;">@lang('messages.text_live_score')</span>
        </div>

        <div id="content_country_19"></div>
        <div id="content_country_27"></div>

        {{--@foreach ($livescore_country_19 as $data)--}}
            {{--<div class="form-group text-center">--}}
                {{--<span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>--}}
                {{--<span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>--}}
            {{--</div>--}}
        {{--@endforeach--}}

        {{--@foreach ($livescore_country_27 as $data)--}}
            {{--<div class="form-group text-center">--}}
                {{--<span>{{ $data[0] }}</span> <span>vs</span> <span>{{ $data[1] }}</span><br>--}}
                {{--<span>Time : {{ $data[3] }}</span> <span>/</span> <span>Score : {{ $data[2] }}</span>--}}
            {{--</div>--}}
        {{--@endforeach--}}

    </div>

    <script>
        $(document).ready(function() {
            $.get('{{ url('dispatch_livescore') }}',
                {

                },
                function(data, status) {
                    //console.log("Data: " + data + "\nStatus: " + status);
                });

            setInterval(function() {
                $.get('{{ url('fetch_livescore') }}',
                    {

                    },
                    function(data, status) {
                        //console.log(JSON.stringify(data).length);
                        if (JSON.stringify(data).length > 2) {
                            //console.log(JSON.stringify(data));

                            //console.log(data['country_19'][0][0]);

                            var content_html_19 = '';
                            var content_html_27 = '';

                            if (data['country_19'] !== undefined
                                && data['country_27'] !== undefined)
                            {
                                for (var i = 0; i < data['country_19'].length; i++) {
                                    content_html_19 += '<div class="form-group text-center">' + '<span>' + data['country_19'][i][0] + '</span> <span>vs</span> <span>' + data['country_19'][i][1] + '</span><br>' + '<span>Time : ' + data['country_19'][i][3] + '</span> <span>/</span> <span>Score : ' + data['country_19'][i][2] + '</span>' + '</div>';
                                }
                                for (var i = 0; i < data['country_27'].length; i++) {
                                    content_html_27 += '<div class="form-group text-center">' + '<span>' + data['country_27'][i][0] + '</span> <span>vs</span> <span>' + data['country_27'][i][1] + '</span><br>' + '<span>Time : ' + data['country_27'][i][3] + '</span> <span>/</span> <span>Score : ' + data['country_27'][i][2] + '</span>' + '</div>';
                                }
                                $('#content_country_19').html(content_html_19);
                                $('#content_country_27').html(content_html_27);

                            } else {
                                if (data['country_19'] !== undefined) {
                                    //console.log(data['country_19'][0]);
                                    for (var i = 0; i < data['country_19'].length; i++) {
                                        content_html_19 += '<div class="form-group text-center">' + '<span>' + data['country_19'][i][0] + '</span> <span>vs</span> <span>' + data['country_19'][i][1] + '</span><br>' + '<span>Time : ' + data['country_19'][i][3] + '</span> <span>/</span> <span>Score : ' + data['country_19'][i][2] + '</span>' + '</div>';
                                    }
                                    $('#content_country_19').html(content_html_19);
                                }

                                if (data['country_27'] !== undefined) {
                                    //console.log(data['country_27'][0]);
                                    for (var i = 0; i < data['country_27'].length; i++) {
                                        content_html_27 += '<div class="form-group text-center">' + '<span>' + data['country_27'][i][0] + '</span> <span>vs</span> <span>' + data['country_27'][i][1] + '</span><br>' + '<span>Time : ' + data['country_27'][i][3] + '</span> <span>/</span> <span>Score : ' + data['country_27'][i][2] + '</span>' + '</div>';
                                    }
                                    $('#content_country_27').html(content_html_27);
                                }
                            }

                        }
                    });
            }, 1000);
        });
    </script>

</div>