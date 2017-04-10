@extends('layouts.layout_user')

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; margin-top: 50px; margin-bottom: 50px;">

                <div class="form-group">
                    <span style="font-size: 28px;" class="font-color-blue">@lang('messages.newsletter')</span>
                </div>

                <form action="{{ url('setting/update/new_sletter') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="" class="font-color-gray" style="font-size: 16px;">@lang('messages.accept')</label>&ensp;
                                <input type="radio" name="status_new_sletter" value="1" @if ($setting->status_new_sletter == 1) checked @endif>
                            </div>
                            &ensp;&ensp;
                            <div class="form-group">
                                <label for="" class="font-color-gray" style="font-size: 16px;">@lang('messages.disaccept')</label>&ensp;
                                <input type="radio" name="status_new_sletter" value="0" @if ($setting->status_new_sletter == 0) checked @endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group text-right" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success btn-bg-green border-green" style="width: 150px;">@lang('messages.save')</button>
                        </div>
                    </div>
                </form>



            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="//border: 1px solid red; //margin-top: 50px; //margin-bottom: 50px;">

                <div class="form-group">
                    <span style="font-size: 28px;" class="font-color-blue">@lang('messages.change_password')</span>
                </div>
                <div class="form-group text-right">
                    <span style="color: red;">{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control border-none input-lg" placeholder="Password (8 characters minimum)" min="8" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control border-none input-lg" placeholder="Re-enter Password" required>
                </div>
                <div class="form-group text-right" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success btn-bg-green border-green" style="width: 150px;">@lang('messages.save')</button>
                </div>

            </div>

        </div>
    </div>

@endsection