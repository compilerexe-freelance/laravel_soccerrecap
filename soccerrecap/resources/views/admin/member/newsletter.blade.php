@extends('layouts.layout_admin')

@section('navbar')
    @include('layouts.components.admin.navbar')
@endsection

@section('content')

    <style>
        tr th {
            text-align: center;
            font-size: 16px;
        }
        tr td {
            text-align: center;
            font-size: 16px;
        }
    </style>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <span style="font-size: 26px;">Newsletter</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="//margin-top: 20px;">

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1" style="margin-top: 20px;">
                    <form action="{{ url('admin/member/newsletter/send') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="topic" class="form-control input-lg" style="font-size: 24px;" placeholder="Topic">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="summernote"></textarea>
                        </div>
                        <div class="form-group text-center" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-success btn-bg-green" style="width: 150px; font-size: 16px;">Send <i class="fa fa-paper-plane"></i></button>
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