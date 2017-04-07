@extends('layouts.layout_admin')

@section('navbar')
    @include('layouts.components.admin.navbar')
@endsection

@section('content')

    <style>
        tr th {
            text-align: center;
            vertical-align: middle !important;
            font-size: 16px;
        }
        tr td {
            text-align: center;
            vertical-align: middle !important;
            font-size: 16px;
        }
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
    </style>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <span style="font-size: 26px;">Pin Story</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="form-group">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th>No</th>
                    <th>Pin Story ID</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                    <form action="{{ url('admin/edit/pin_story/update') }}" method="post">
                        {{ csrf_field() }}
                        <tr>
                            <td class="fit">1</td>
                            <td class="fit"><input type="text" class="form-control"  name="story_id_1" value="{{ $pin_story->story_id_1 }}"></td>
                            <td class="fit"><button type="submit" class="btn btn-bg-green" style="width: 100%">Save</button></td>
                            <td class="fit"><a href="{{ url('admin/edit/pin_story/disable/1') }}"><button type="button" class="btn btn-danger" style="width: 100%">Disable</button></a></td>
                        </tr>
                    </form>

                    <form action="{{ url('admin/edit/pin_story/update') }}" method="post">
                        {{ csrf_field() }}
                        <tr>
                            <td class="fit">2</td>
                            <td class="fit"><input type="text" class="form-control" name="story_id_2" value="{{ $pin_story->story_id_2 }}"></td>
                            <td class="fit"><button type="submit" class="btn btn-bg-green" style="width: 100%">Save</button></td>
                            <td class="fit"><a href="{{ url('admin/edit/pin_story/disable/2') }}"><button type="button" class="btn btn-danger" style="width: 100%">Disable</button></a></td>
                        </tr>
                    </form>

                </tbody>
            </table>
        </div>

    </div>

@endsection