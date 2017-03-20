@if (Auth::check())

    <nav class="navbar navbar-default" style="border-radius: 0px;">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('images/logo.png') }}" class="img-responsive" style="height: 100%;" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li @if (session('navbar') == 'home') class="active" @endif><a href="{{ url('/') }}">Latest picks</a></li>
                    <li @if (session('navbar') == 'following') class="active" @endif><a href="{{ url('/following') }}">Following</a></li>
                    <li @if (session('navbar') == 'top_stories') class="active" @endif><a href="{{ url('/top_stories') }}">Top stories</a></li>
                    <li @if (session('navbar') == 'bookmarks') class="active" @endif><a href="{{ url('/bookmarks') }}">Bookmarks</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Knowledge
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Windows</a></li>
                            <li><a href="#">Linux</a></li>
                            <li><a href="#">OSX</a></li>
                        </ul>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left text-center" action="#" method="post">

                        <div class="form-group">
                            <i class="fa fa-search fa-lg font-color-gray"></i>
                            <input type="text" class="form-control" placeholder="Tag, Stories, People" style="border-radius: 20px;">
                        </div>

                        <div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                            <button type="button" class="btn btn-info btn-remove-shadow" style="border-radius: 20px; width: 100%; color: dodgerblue">Write a Story</button>
                        </div>

                        <div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                            <button
                                    type="button"
                                    class="btn btn-success btn-remove-shadow"
                                    style="-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%; width: 100%; color: #808080; border: 1px solid #808080;"
                                    data-toggle="popover"
                                    data-trigger="focus"
                                    data-html="true"
                                    title="Notifications"
                                    data-placement="bottom"
                                    data-content="

                            ">
                                <i class="fa fa-bell-o"></i>
                            </button>
                        </div>

                        <div class="form-group link-gray" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                            <a href="#"
                               data-toggle="popover"
                               data-trigger="focus"
                               data-html="true"
                               title=""
                               data-placement="bottom"
                               data-content="
                            <a href='{{ url('write_story') }}'>New story</a><br>
                            <a href='{{ url('my_stories') }}'>Drafts and stories</a>
                            <hr style='margin-top: 10px !important;; margin-bottom: 10px !important;'>
                            <a href='{{ url('profile') }}' style='font-size: 15px !important;'>Profile</a><br>
                            <a href='{{ url('setting') }}' style='font-size: 15px !important;'>Setting</a><br>
                            <a href='{{ url('sign_out') }}' style='font-size: 15px !important;'>Sign out</a>
                           "
                            >

                                @php
                                    $profile = App\Profile::find(Auth::user()->id);
                                @endphp

                                @if ($profile->image_profile != null)
                                    <img src="data:image/jpeg;base64,{{ base64_encode(Storage::get('image_profiles/'.Auth::user()->id)) }}"
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
                        </div>

                        <div class="form-group text-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">&ensp;&ensp;EN
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Change to Thai</a></li>
                                </ul>
                            </li>
                        </div>

                    </form>

                </ul>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>

@else

    <nav class="navbar navbar-default" style="border-radius: 0px; margin-bottom: 0px;">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('images/logo.png') }}" class="img-responsive" style="height: 100%;" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li @if (session('navbar') == 'home') class="active" @endif><a href="{{ url('/') }}">Latest picks</a></li>
                    <li @if (session('navbar') == 'following') class="active" @endif><a href="{{ url('/following') }}">Following</a></li>
                    <li @if (session('navbar') == 'top_stories') class="active" @endif><a href="{{ url('/top_stories') }}">Top stories</a></li>
                    <li @if (session('navbar') == 'bookmarks') class="active" @endif><a href="{{ url('/bookmarks') }}">Bookmarks</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Knowledge
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Windows</a></li>
                            <li><a href="#">Linux</a></li>
                            <li><a href="#">OSX</a></li>
                        </ul>
                    </li>

                    {{--<li><a href="#">Latest picks</a></li>--}}
                    {{--<li><a href="#">Following</a></li>--}}
                    {{--<li><a href="#">Top stories</a></li>--}}
                    {{--<li><a href="#">Bookmarks</a></li>--}}
                    {{--<li><a href="#">Knowledge</a></li>--}}

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" action="{{ url('/search') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <i class="fa fa-search fa-lg font-color-gray"></i>
                            <input type="text" class="form-control" name="keyword" placeholder="Tag, Stories, People" style="border-radius: 20px;">
                            <button type="submit" hidden>Submit</button>
                        </div>
                        {{--<div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">--}}
                            {{--<a href="{{ url('/posts/new') }}"><button type="button" class="btn btn-info btn-remove-hover" style="border-radius: 20px; width: 100%; color: dodgerblue">Write a Story</button></a>--}}
                        {{--</div>--}}
                        <div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                            <button type="button" class="btn btn-success btn-remove-hover" id="btn-sign-in" style="border-radius: 20px; width: 100%; color: #03B876"">Sign In / Sign Up</button>
                        </div>

                        <div class="form-group text-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">&ensp;&ensp;EN
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Change to Thai</a></li>
                                </ul>
                            </li>
                        </div>

                    </form>

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
                    <button type="button" class="btn btn-primary" style="background-color: #0d71bb !important; font-size: 18px;"><i class="fa fa-facebook-official"></i> Sign in with Facebook</button>
                </div>
                <div class="form-group">
                    <a href="#" id="link-sign-in-email" style="text-decoration: none;"><span style="font-size: 16px;" class="font-color-green">Sign in or Sign up with email</span></a>
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
                        <span id="message_sign_in" style="font-size: 20px; color: red;"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="sign_in_email" value="{{ old('sign_in_email') }}" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="sign_in_password" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Password" required>
                    </div>
                    <div class="form-group text-right">
                        <div class="checkbox">
                            <label class="font-color-gray">
                                <input type="checkbox"> Remember
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="button" id="btn-sign-up-email" class="btn btn-success btn-remove-shadow font-color-green pull-left" style="font-size: 18px; width: 150px;">Sign up</button>
                        <button type="submit" class="btn btn-success btn-remove-hover btn-bg-green pull-right" style="font-size: 18px; width: 150px;">Login</button>
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
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Username (8 characters minimum)" minlength="8"  maxlength="15" required>
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
                        <input type="password" name="password" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Password (8 characters minimum)" minlength="8" maxlength="15" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control input-lg border-none" style="font-size: 20px;" placeholder="Re-enter Password" minlength="8" maxlength="15" required>
                    </div>

                    <div class="form-group text-right" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-success btn-remove-hover btn-bg-green text-right" style="font-size: 18px; width: 150px;">Create Account</button>
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
                <h4 class="modal-title" id="myModalLabel">Alert</h4>
            </div>

            <div class="modal-body text-center" style="">

                <div class="form-group">
                    <span style="font-size: 36px; color: green;">Success</span>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-bg-green" data-dismiss="modal" style="width: 110px;">Close</button>
            </div>

        </div>
    </div>
</div>

@if (!empty($errors->all()))
    <script>
        $(document).ready(function() {
            $('#Modal-Sign-Up-Email').modal();
        });
    </script>
@endif

@if (session('status_sign_up') == 'success')
    <script>
        $(document).ready(function() {
            $('#Modal-SignUp-Success').modal();
        });
    </script>
@endif

@if (session('status_sign_in') == 'fail')
    <script>
        $(document).ready(function() {
            $('#message_sign_in').text('Please check email or password again.')
            $('#Modal-Sign-In-Email').modal();
        });
    </script>
@endif

<script>
    $(document).ready(function() {

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