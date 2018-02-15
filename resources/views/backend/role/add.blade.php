@extends('backend.layouts.app')
@section('title')
    Rol Ekle
    @endsection
    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <a href="{{ route('role.index') }}" class="btn btn-primary">Rol Listesi</a>
                </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Rol Ekle</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            @include('backend.layouts.message')

                            {!! Form::open(['route' => 'role.store','class'=>'form-horizontal form-label-left','data-parsley-validate novalidate']) !!}

                            <div class="form-group">
                                {{ Form::label('name', 'Rol Adı*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('name','',['class' => 'form-control col-md-7 col-xs-12','required']) }}

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">İzinler

                                </label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                   @foreach($permissions as $key=>$value)
                                    <div class="checkbox col-md-4 col-xs-12">
                                        <label>

                                            {{ Form::checkbox('permissions[]',$key,null,['class'=>'flat']) }} {{$value}}
                                        </label>
                                    </div>

                                       @endforeach

                                </div>
                            </div>





                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {{ Form::submit('Kaydet',['class'=>'btn btn-success']) }}


                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('css')

    <link href="{{ asset('backend/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    @endsection
@section('js')
    <script src="{{ asset('backend/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/vendors/parsleyjs/dist/i18n/tr.js')}}"></script>
    <script src="{{ asset('backend/vendors/iCheck/icheck.min.js') }}"></script>
    @endsection