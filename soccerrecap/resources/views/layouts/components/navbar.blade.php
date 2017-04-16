@if (Auth::check())

    <style>
        .navbar-header {
            padding-top: 14px;
        }
        .navbar-nav {
        //border: 1px solid red;
        }
        .navbar-left-padding {
        //border: 1px solid blue;
            padding-top: 14px;
            padding-bottom: 10px;
        }
        .navbar-nav .active {
        //border: 1px solid green;
        }
        .navbar-right {
        //border: 1px solid pink;
        }
    </style>

    <nav class="navbar navbar-default" style="border-radius: 0px;">
        <div class="container-fulid">

            <div class="navbar-header">
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
                <ul class="nav navbar-nav navbar-left-padding">

                    <li @if (session('navbar') == 'home') class="active" @endif><a href="{{ url('/') }}">@lang('messages.latest_pick')</a></li>
                    {{--<li @if (session('navbar') == 'following') class="active" @endif><a href="{{ url('/following') }}">Following</a></li>--}}

                    <li @if (session('navbar') == 'following') class="active dropdown" @else class="dropdown" @endif>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('messages.following')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('following/users') }}">@lang('messages.following_user')</a></li>
                            <li><a href="{{ url('following/tags') }}">@lang('messages.following_tag')</a></li>
                        </ul>
                    </li>

                    <li @if (session('navbar') == 'top_stories') class="active" @endif><a href="{{ url('/top_stories') }}">@lang('messages.top_stories')</a></li>
                    <li @if (session('navbar') == 'bookmarks') class="active" @endif><a href="{{ url('/bookmarks') }}">@lang('messages.bookmarks')</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('messages.knowledge')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @php
                                $knowledges = \App\Knowledge::all();
                            @endphp
                            @if ($knowledges)
                                @foreach ($knowledges as $knowledge)
                                    @php
                                        $tag = \App\Tag::find($knowledge->tag_id);
                                    @endphp
                                    <li><a href="{{ url('tag/'.$tag->id) }}">{{ $tag->tag_name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li style="padding-top: 5px;">
                        <a href="#">
                            <input type="text" id="keyword" class="form-control" placeholder="Tag, Stories, People" style="border-radius: 20px !important;">
                        </a>
                    </li>
                    <li style="padding-top: 5px;">
                        <a href="#" style="padding-left: 0px">
                            <button type="button" id="btn_search" class="btn btn-bg-white border-blue font-color-blue">@lang('messages.search')</button>
                        </a>
                    </li>

                    {{-- notification --}}

                    <li class="dropdown" style="padding-top: 10px" id="display_notification">

                    </li>

                    {{-- end notification--}}

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                            {{ Auth::user()->username }}

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

                    <li class="dropdown" style="padding-top: 10px">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">&ensp;&ensp;@lang('messages.language')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('lang/th') }}">@lang('messages.th')</a></li>
                            <li><a href="{{ url('lang/en') }}">@lang('messages.en')</a></li>
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

        $(document).ready(function() {
            $('#btn_search').on('click', function() {
                var keyword = $('#keyword').val();
                if (keyword == "") {
                    keyword = "none";
                }
                window.location.href = '{{ url('search') }}/' + keyword;

                {{--$.post('{{ url('search') }}',--}}
                {{--{--}}
                    {{--_token: '{{ csrf_token() }}',--}}
                    {{--keyword: $('#keyword').val()--}}
                {{--},--}}
                {{--function(data, status) {--}}
                    {{--console.log("Data: " + data + "\nStatus: " + status);--}}
                {{--});--}}
            });
        });

    </script>

@else

    <nav class="navbar navbar-default" style="border-radius: 0px; //margin-bottom: 0px;">
        <div class="container-fulid">

            <div class="navbar-header" style="padding-top: 7px;">
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
                <ul class="nav navbar-nav" style="padding: 7px;">

                    <li @if (session('navbar') == 'home') class="active" @endif><a href="{{ url('/') }}">@lang('messages.latest_pick')</a></li>
                    <li @if (session('navbar') == 'following') class="active" @endif><a href="#">@lang('messages.following')</a></li>
                    <li @if (session('navbar') == 'top_stories') class="active" @endif><a href="#">@lang('messages.top_stories')</a></li>
                    <li @if (session('navbar') == 'bookmarks') class="active" @endif><a href="#">@lang('messages.bookmarks')</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('messages.knowledge')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @php
                                $knowledges = \App\Knowledge::all();
                            @endphp
                            @if ($knowledges)
                                @foreach ($knowledges as $knowledge)
                                    @php
                                        $tag = \App\Tag::find($knowledge->tag_id);
                                    @endphp
                                    <li><a href="{{ url('tag/'.$tag->id) }}">{{ $tag->tag_name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="#">
                            <input type="text" id="txt_search" class="form-control" placeholder="Tag, Stories, People" style="border-radius: 20px !important;">
                        </a>
                    </li>
                    <li>
                        <a href="#" style="padding-left: 0px">
                            <button type="button" id="btn_search" class="btn btn-bg-white font-color-blue border-blue">@lang('messages.search')</button>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <button type="button" class="btn btn-success btn-bg-blue border-blue" id="btn-sign-in" style="border-radius: 20px; width: 100%; color: #03B876">Sign In / Sign Up</button>
                        </a>
                    </li>

                    <li class="dropdown" style="padding-top: 10px">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">&ensp;&ensp;@lang('messages.language')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('lang/th') }}">@lang('messages.th')</a></li>
                            <li><a href="{{ url('lang/en') }}">@lang('messages.en')</a></li>
                        </ul>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

@endif

<div id="Modal-Sign-In" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body text-center">
                <div class="form-group">
                    <span style="font-size: 16px;" class="font-color-gray"><b>Sign in or create an account</b></span>
                </div>
                <div class="form-group">
                    <a href="{{ url('login/facebook') }}"><button type="button" class="btn btn-primary border-blue" style="background-color: #0d71bb !important; font-size: 18px;"><i class="fa fa-facebook-official"></i> Sign in with Facebook</button></a>
                </div>
                <div class="form-group">
                    <a href="#" id="link-sign-in-email" style="text-decoration: none;"><span style="font-size: 16px;" class="font-color-blue">Sign in or Sign up with email</span></a>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="Modal-Sign-In-Email" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body text-center" style="padding-bottom: 60px;">

                <form action="{{ url('sign_in') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group text-right">
                        @if (session('status_sign_in'))
                            <span id="message_sign_in" style="font-size: 20px; color: red;">Please check email or password again.</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="email" name="sign_in_email" value="{{ old('sign_in_email') }}" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="sign_in_password" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Password" required>
                    </div>
                    <div class="form-group text-right">
                        <div class="checkbox">
                            <label class="font-color-gray">
                                <input type="checkbox" name="remember" value="1"> Remember
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="button" id="btn-sign-up-email" class="btn btn-bg-white btn-remove-shadow font-color-blue border-blue pull-left" style="font-size: 18px; width: 150px;">Sign up</button>
                        <button type="submit" class="btn btn-success btn-remove-hover btn-bg-blue border-blue pull-right" style="font-size: 18px; width: 150px;">Login</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div id="Modal-Sign-Up-Email" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body text-center" style="//padding-bottom: 60px;">

                <form action="{{ url('sign_up') }}" method="post">

                    {{ csrf_field() }}

                    <div class="form-group text-left">
                        <span style="font-size: 28px;">Sign up</span>
                    </div>

                    <div class="form-group text-right">
                        <span style="color: red;">{{ $errors->first('username') }}</span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Username (2 characters minimum)" minlength="2"  maxlength="15" required>
                    </div>

                    <div class="form-group text-right">
                        <span style="color: red;">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Email" required>
                    </div>

                    <div class="form-group text-right">
                        <span style="color: red;">{{ $errors->first('password') }}</span>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Password (8 characters minimum)" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Re-enter Password" minlength="8" required>
                    </div>

                    <div class="form-group text-right" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-remove-hover btn-bg-blue border-blue text-right" style="font-size: 18px; width: 150px;">Create Account</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div id="Modal-SignUp-Success" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Notification</h4>
            </div>

            <div class="modal-body text-center" style="">

                <div class="form-group">
                    <span style="font-size: 36px; color: green;">Success</span>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-bg-blue" data-dismiss="modal" style="width: 110px;">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        @if (!empty($errors->all()))
            $('#Modal-Sign-Up-Email').modal();
        @endif

        @if (session('status_sign_up') == 'success')
//            $('#Modal-SignUp-Success').modal();
            alert('ลงทะเบียนสำเร็จ');
        @endif

        @if (session('status_sign_in'))
            $('#Modal-Sign-In-Email').modal();
        @endif

        @if (session('facebook_error') == 'fail')
            alert('อีเมล {{session('facebook_email')}} มีการใช้ลงทะเบียนแล้ว');
        @endif

        $('#btn-sign-in').on('click', function() {
            $('#Modal-Sign-In').modal();
        });

        $('#link-sign-in-email').on('click', function() {
            $('#Modal-Sign-In').modal('hide');
            $('#Modal-Sign-In-Email').modal();
        });

        $('#btn-sign-up-email').on('click', function() {
            $('#Modal-Sign-In-Email').modal('hide');
            $('#Modal-Sign-Up-Email').modal();
        });

    });
</script>
