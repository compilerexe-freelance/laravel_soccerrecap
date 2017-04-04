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

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th>Story ID</th>
                <th>Story Title</th>
                <th>Likes</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($storys as $story)
                @php
                    $story_count = \App\StoryCount::find($story->id);
                @endphp
                <tr>
                    <td>{{ $story->id }}</td>
                    <td>{{ $story->story_title }}</td>
                    <td>{{ $story_count->count_like }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection