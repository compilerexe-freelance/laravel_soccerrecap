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
                    <th>Member ID</th>
                    <th>Username</th>
                    <th>Follows</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($follows_member as $follow)
                    @php
                        $member = \App\Member::find($follow->member_id);
                        $total_follows = \App\FollowsMember::where('follow_member_id', $follow->member_id)->get();
                    @endphp
                    <tr>
                        <td>{{ $follow->member_id }}</td>
                        <td>{{ $member->username }}</td>
                        <td>{{ count($total_follows) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection