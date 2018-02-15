@extends('backend.layouts.app')
@section('title')
    Mail Ayarları
    @endsection
    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">


            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Mail Ayarları</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            @include('backend.layouts.message')

                            {!! Form::open(['route' => 'setting.smtp','class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {{ Form::label('mail_host', 'SMTP Host', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_host',$smtp["host"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('mail_user', 'SMTP Kullanıcı Adı', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_user',$smtp["username"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mail_pass', 'SMTP Şifre', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_pass',$smtp["password"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mail_port', 'SMTP Port', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_port',$smtp["port"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mail_enc', 'SMTP Port', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    {{   Form::select('mail_enc', ['ssl' => 'SSL', 'tls' => 'TLS'], $smtp["encryption"], ['class' => 'form-control col-md-7 col-xs-12','placeholder' => 'Seçiniz'])}}

                                  </div>
                              </div>
                            <div class="form-group">
                                {{ Form::label('mail_from_user', 'Gönderici Adı', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_from_user',$smtp["from"]["name"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mail_from_adres', 'Gönderici Mail', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_from_adres',$smtp["from"]["address"],['class' => 'form-control col-md-7 col-xs-12']) }}

                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('mail_admin', 'Admin Mail', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('mail_admin',$smtp["mail_admin"],['class' => 'form-control col-md-7 col-xs-12']) }}
                                    <span class="help-block"> Tüm mailler bu adrese gönderilecek</span>

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
    <script src="{{ asset('backend/vendors/iCheck/icheck.min.js') }}"></script>
@endsection