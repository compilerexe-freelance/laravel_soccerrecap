@extends('layouts.layout_admin')

@section('navbar')
    @include('layouts.components.admin.navbar')
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-md-10 col-md-offset-1">

                    <div class="form-group">
                        <span style="font-size: 26px;">Contact</span>
                    </div>

                    <form action="{{ url('admin/edit/contact') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="contact_title" value="{{ $contact_title }}" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <textarea name="contact_detail" class="summernote">{!! $contact_detail !!}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-bg-green" style="width: 150px; font-size: 16px;"> Save</button>
                        </div>

                    </form>

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