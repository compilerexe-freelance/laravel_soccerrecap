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

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th>Story ID</th>
                    <th>Story Title</th>
                    <th>Tag 1</th>
                    <th>Tag 2</th>
                    <th>Tag 3</th>
                    <th>Tag 4</th>
                    <th>Tag 5</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($storys as $story)
                    @php
                        $tag1 = ""; $tag2 = ""; $tag3 = ""; $tag4 = ""; $tag5 = "";
                        $tag1_id = 0; $tag2_id = 0; $tag3_id = 0; $tag4_id = 0; $tag5_id = 0;

                        $tags = \App\Tag::where('story_id', $story->id)->get();
                        foreach ($tags as $key => $value) {
                            if ($key == 0) {
                                $tag1 = $value->tag_name;
                                $tag1_id = $value->id;
                            } else if ($key == 1) {
                                $tag2 = $value->tag_name;
                                $tag2_id = $value->id;
                            } else if ($key == 2) {
                                $tag3 = $value->tag_name;
                                $tag3_id = $value->id;
                            } else if ($key == 3) {
                                $tag4 = $value->tag_name;
                                $tag4_id = $value->id;
                            } else {
                                $tag5 = $value->tag_name;
                                $tag5_id = $value->id;
                            }
                        }
                    @endphp
                    <form action="{{ url('admin/edit/tags_story/update') }}" method="post">
                        {{ csrf_field() }}
                        <tr>
                            <td>{{ $story->id }}</td>
                            <td>{{ $story->story_title }}</td>
                            <td><input type="text" name="tag_1" class="form-control" value="{{ $tag1 }}"></td>
                            <td><input type="text" name="tag_2" class="form-control" value="{{ $tag2 }}"></td>
                            <td><input type="text" name="tag_3" class="form-control" value="{{ $tag3 }}"></td>
                            <td><input type="text" name="tag_4" class="form-control" value="{{ $tag4 }}"></td>
                            <td><input type="text" name="tag_5" class="form-control" value="{{ $tag5 }}"></td>

                            <input type="hidden" name="tag1_id" value="{{ $tag1_id }}">
                            <input type="hidden" name="tag2_id" value="{{ $tag2_id }}">
                            <input type="hidden" name="tag3_id" value="{{ $tag3_id }}">
                            <input type="hidden" name="tag4_id" value="{{ $tag4_id }}">
                            <input type="hidden" name="tag5_id" value="{{ $tag5_id }}">

                            <td><button type="submit" class="btn btn-success btn-bg-green">Save</button></td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection