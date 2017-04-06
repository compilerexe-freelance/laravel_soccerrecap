@extends('layouts.layout_admin')

@section('navbar')
    @include('layouts.components.admin.navbar')
@endsection

@section('content')

<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group animated fadeInDown" style="margin-top: 20px;">
                <span style="font-size: 26px;">Total Visitors : {{ $count_visitor }}</span>
            </div>
        </div>
    </div>

</div>

@endsection