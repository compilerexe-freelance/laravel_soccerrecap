@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <style>
        tr th {
            text-align: center;
            font-size: 14px !important;
        }
        tr td {
            text-align: center;
            font-size: 14px !important;
        }
    </style>

    <div class="panel panel-default" style="-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;">
        <div class="panel-body">

            <div class="col-md-8 col-md-offset-2">

                <div class="form-group">
                    <span style="font-size: 26px; font-weight: bold;" class="font-color-blue">@lang('messages.following')</span>
                </div>

                <div class="form-group table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>@lang('messages.table_no')</th>
                            <th>@lang('messages.table_tag_name')</th>
                            <th>@lang('messages.table_date')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_tag_followings as $list_tag_following)
                            @php
                                $tag = \App\Tag::find($list_tag_following->follow_tag_id);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tag->tag_name }}</td>
                                <td>{{ $tag->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection