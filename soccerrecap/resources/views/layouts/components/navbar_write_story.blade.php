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
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left text-center" action="#" method="post">

                    <div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                        <button
                                type="button"
                                class="btn btn-success"
                                style="border-radius: 20px; width: 100%; color: #03B876"
                                data-toggle="popover"
                                data-trigger="focus"
                                data-html="true"
                                title="Ready to Publish"
                                data-placement="bottom"
                                data-content="
                            Add tags to reach more people<br>
                            <input type='text' class='form-control border-none' placeholder='Tag 1'><br>
                            <input type='text' class='form-control border-none' placeholder='Tag 2'><br>
                            <input type='text' class='form-control border-none' placeholder='Tag 3'><br>
                            <input type='text' class='form-control border-none' placeholder='Tag 4'><br>
                            <input type='text' class='form-control border-none' placeholder='Tag 5'><br>
                            <button type='button' class='btn btn-success btn-bg-green' style='border-radius: 20px; width: 100%; color: #03B876; margin-top: 20px;'>Publish</button>
                            ">
                            Publish <i class="fa fa-chevron-down"></i>
                        </button>
                    </div>

                    <div class="form-group" style="//padding-left: 10px !important; //padding-right: 10px !important;">
                        <button
                                type="button"
                                class="btn btn-success"
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
                            <a href='#'>New story</a><br>
                            <a href='#'>Drafts and stories</a>
                            <hr style='margin-top: 10px !important;; margin-bottom: 10px !important;'>
                            <a href='#' style='font-size: 15px !important;'>Profile</a><br>
                            <a href='#' style='font-size: 15px !important;'>Sign out</a>
                           "
                        >
                            <img src="{{ url('images/icons/me.jpg') }}"
                                 style="width: 40px !important; height: 40px !important;"
                                 class="img-circle"
                                 alt="">
                        </a>
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