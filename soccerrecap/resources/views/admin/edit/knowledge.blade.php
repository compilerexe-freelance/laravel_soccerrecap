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
            <span style="font-size: 26px;">Knowledge</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-8 col-fulid" style="margin-bottom: 20px;">
            <div class="form-inline text-right">
                <form action="{{ url('admin/edit/knowledge/insert') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="tag_id" placeholder="Tag ID">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-bg-green">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-group">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th>Tag ID</th>
                    <th>Tag Name</th>
                    <th>Sort</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($knowledges as $knowledge)
                        @php
                            $tag = \App\Tag::find($knowledge->tag_id);
                        @endphp
                        <tr>
                            <td class="fit">{{ $knowledge->tag_id }}</td>
                            <td class="fit">{{ $tag->tag_name }}</td>
                            <form action="{{ url('admin/edit/knowledge/sort/update/'.$knowledge->id) }}" method="post">
                                {{ csrf_field() }}
                                <td class="fit"><input type="text" class="form-control" name="sort" value="{{ $knowledge->sort }}" style="width: 100%;"></td>
                                <td class="fit"><button type="submit" class="btn btn-bg-green" style="width: 100%">Save</button></td>
                            </form>
                            <td class="fit"><a href="{{ url('admin/edit/knowledge/sort/delete/'.$knowledge->id) }}"><button type="button" class="btn btn-danger" style="width: 100%">Remove</button></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

@endsection