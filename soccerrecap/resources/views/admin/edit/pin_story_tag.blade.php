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
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
    </style>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <span style="font-size: 26px;">Pin Story Tag</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th>Tag ID</th>
                    <th>Tag Name</th>
                    <th>Story ID</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)

                        @php
                            $pin_tag = \App\StickTagFeed::find($tag->id);
                            $story_id = "";
                            if ($pin_tag) {
                                $story_id = $pin_tag->story_id;
                            }
                        @endphp

                        <form action="{{ url('admin/edit/pin_story_tag/update/'.$tag->id) }}" method="post">
                            {{ csrf_field() }}
                            <tr>
                                <td class="fit">{{ $tag->id }}</td>
                                <td class="fit">{{ $tag->tag_name }}</td>
                                <td class="fit"><input type="text" class="form-control" name="story_id" value="{{ $story_id }}"></td>
                                <td class="fit"><button type="submit" class="btn btn-bg-green" style="width: 100%;">Save</button></td>
                            </tr>
                        </form>

                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection