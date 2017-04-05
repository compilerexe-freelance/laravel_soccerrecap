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
            <span style="font-size: 26px;">Permission</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th>Member ID</th>
                <th>Username</th>
                <th>Temporary Suspend</th>
                <th>Suspended</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $permission)
                @php
                    $member = \App\Member::find($permission->member_id);
                @endphp
                <tr>
                    <td>{{ $permission->member_id }}</td>
                    <td>{{ $member->username }}</td>
                    @if ($permission->temporary_suspend == 0)
                        <td><a href="{{ url('admin/permission/temporary_suspend/confirm/'.$permission->member_id) }}" style="text-decoration: none; color: green;">confirm</a></td>
                    @else
                        <td><a href="{{ url('admin/permission/temporary_suspend/cancel/'.$permission->member_id) }}" style="text-decoration: none; color: red;">cancel</a></td>
                    @endif

                    @if ($permission->suspended == 0)
                        <td><a href="{{ url('admin/permission/suspended/confirm/'.$permission->member_id) }}" style="text-decoration: none; color: green;">confirm</a></td>
                    @else
                        {{--<td><a href="{{ url('admin/permission/suspended/cancel/'.$permission->member_id) }}" style="text-decoration: none; color: red;">cancel</a></td>--}}
                        <td><span style="color: red;">suspended</span></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection