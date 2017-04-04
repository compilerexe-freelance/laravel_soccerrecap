@extends('layouts.layout_admin')

@section('navbar')
    @include('layouts.components.admin.navbar')
@endsection

@section('content')

    <style>
        tr th {
            text-align: center;
            font-size: 16px;
            vertical-align: middle !important;
        }
        tr td {
            text-align: center;
            font-size: 16px;
            vertical-align: middle !important;
        }
    </style>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <span style="font-size: 26px;">Editor Pick</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">

        @php
            $editor_pick = \App\EditorPick::find(1);
            $editor_pick_1 = "";
            $editor_pick_2 = "";
            $editor_pick_3 = "";
            $editor_pick_4 = "";
            $editor_pick_5 = "";
            if ($editor_pick) {
                $editor_pick_1 = $editor_pick->story_id_1;
                $editor_pick_2 = $editor_pick->story_id_2;
                $editor_pick_3 = $editor_pick->story_id_3;
                $editor_pick_4 = $editor_pick->story_id_4;
                $editor_pick_5 = $editor_pick->story_id_5;
            }
        @endphp

        <form action="{{ url('admin/edit/editor_pick/update') }}" method="post">
            {{ csrf_field() }}
            <div class="col-md-2">
                <div class="form-group">
                    <span style="font-size: 16px;">Story ID</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="editor_pick_1" value="{{ $editor_pick_1 }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <span style="font-size: 16px;">Story ID</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="editor_pick_2" value="{{ $editor_pick_2 }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-group">
                        <span style="font-size: 16px;">Story ID</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="editor_pick_3" value="{{ $editor_pick_3 }}">
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <span style="font-size: 16px;">Story ID</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="editor_pick_4" value="{{ $editor_pick_4 }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <span style="font-size: 16px;">Story ID</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="editor_pick_5" value="{{ $editor_pick_5 }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <span style="font-size: 16px; visibility: hidden;">...</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-bg-green" style="width: 100%;">Save</button>
                </div>
            </div>
        </form>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th>Story ID</th>
                    <th>Story Title</th>
                    <th>Username</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($storys as $story)

                        @php
                            $member = \App\Member::find($story->member_id);
                        @endphp

                        <tr>
                            <td>{{ $story->id }}</td>
                            <td>{{ $story->story_title }}</td>
                            <td>{{ $member->username }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->created_at)->toFormattedDateString() }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection