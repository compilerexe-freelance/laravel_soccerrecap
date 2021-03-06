<nav class="navbar navbar-default" style="border-radius: 0px;">
    <div class="container-fulid">

        <div class="navbar-header" style="padding-top: 12px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand font-color-gray" href="{{ url('/') }}">
                <img src="{{ url('images/soccerrecap_blue.png') }}" class="img-responsive" style="height: 100%;" alt="">
                {{--Soccerrecap--}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown" style="padding-top: 10px" id="display_notification"></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->username }}
                        <span class="caret"></span>&ensp;
                        @if (file_exists(public_path('uploads/profile_images/'.Auth::user()->id)))
                            <img src="{{ url('uploads/profile_images/'.Auth::user()->id) }}"
                                 style="width: 40px !important; height: 40px !important;"
                                 class="img-circle"
                                 alt="">
                        @else
                            <img src="{{ url('images/icons/user.png') }}"
                                 style="width: 40px !important; height: 40px !important;"
                                 class="img-circle"
                                 alt="">
                        @endif
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href='{{ url('posts/new') }}' style='font-size: 15px !important;'>@lang('messages.new_story')</a></li>
                        <li><a href='{{ url('my_stories') }}' style='font-size: 15px !important;'>@lang('messages.stories')</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href='{{ url('profile') }}' style='font-size: 15px !important;'>@lang('messages.profile')</a></li>
                        <li><a href='{{ url('setting') }}' style='font-size: 15px !important;'>@lang('messages.setting')</a></li>
                        <li><a href='{{ url('sign_out') }}' style='font-size: 15px !important;'>@lang('messages.sign_out')</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>

<script>
    $(document).ready(function(){
        setInterval(function() {
            $.get("{{ url('notification/fetch') }}", function (result) {
                $('#display_notification').html(result);
            });
        }, 1000);
    });
</script>