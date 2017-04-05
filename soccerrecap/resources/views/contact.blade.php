@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-10 col-md-offset-1">

                    {{--<div class="form-group">--}}
                        {{--<span style="font-size: 26px;">Contact</span>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <span style="font-size: 26px;">{{ $contact_title }}</span>
                    </div>

                    <div class="form-group">
                        {!! $contact_detail !!}
                    </div>

                </div>

            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {

            $('.summernote').summernote({
                //toolbar: false,
                height: 500,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });

        });
    </script>

@endsection