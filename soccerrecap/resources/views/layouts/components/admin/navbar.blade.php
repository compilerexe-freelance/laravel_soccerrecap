<nav class="navbar navbar-default" style="border-radius: 0px; margin-bottom: 0px;">
    <div class="container">

        <div class="navbar-header" style="padding-top: 7px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/admin/main') }}">
                <img src="{{ url('images/soccerrecap_blue.png') }}" class="img-responsive" style="height: 100%;" alt="">
                {{--Soccerrecap--}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left" style="padding: 7px;">

                <li @if (session('navbar') == 'main') class="active" @endif><a href="{{ url('/admin/main') }}">Main</a></li>

                <li @if (session('navbar') == 'member') class="dropdown active" @else class="dropdown" @endif>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Member
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('admin/member/newsletter') }}">Newsletter</a></li>
                        <li><a href="{{ url('admin/member/permission') }}">Permission</a></li>
                    </ul>
                </li>

                <li @if (session('navbar') == 'edit') class="dropdown active" @else class="dropdown" @endif>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Edit
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('admin/edit/pin_story') }}">Pin story feed</a></li>
                        <li><a href="{{ url('admin/edit/pin_story_tag/') }}">Pin story tag</a></li>
                        <li><a href="{{ url('admin/edit/tags_story') }}">Tag stories</a></li>
                        <li><a href="{{ url('admin/edit/editor_pick') }}">Editor pick</a></li>
                        <li><a href="{{ url('admin/edit/knowledge') }}">Knowledge</a></li>
                        <li><a href="{{ url('admin/edit/contact') }}">Contact</a></li>
                    </ul>
                </li>

                <li @if (session('navbar') == 'report') class="dropdown active" @else class="dropdown" @endif>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('admin/report/follows') }}">Follows</a></li>
                        <li><a href="{{ url('admin/report/story_likes') }}">Story likes</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right" style="padding: 7px;">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle"></i> {{ Auth::guard('admin')->user()->username }}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>