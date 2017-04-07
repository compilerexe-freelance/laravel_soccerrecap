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
                            <a href='{{ url('posts/new') }}'>New story</a><br>
                            <a href='{{ url('my_stories') }}'>Drafts and stories</a>
                            <hr style='margin-top: 10px !important;; margin-bottom: 10px !important;'>
                            <a href='{{ url('profile') }}' style='font-size: 15px !important;'>Profile</a><br>
                            <a href='{{ url('setting') }}' style='font-size: 15px !important;'>Setting</a><br>
                            <a href='{{ url('sign_out') }}' style='font-size: 15px !important;'>Sign out</a>
                           "
                        >
                            <img src="{{ url('images/icons/me.jpg') }}"
                                 style="width: 40px !important; height: 40px !important;"
                                 class=""
                                 alt="">
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