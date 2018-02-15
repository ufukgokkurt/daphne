@extends('backend.layouts.app')
@section('title')
    Genel Ayarlar
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
                            <h2>Genel Ayarlar</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            @include('backend.layouts.message')

                            {!! Form::open(['route' => 'setting.general','class'=>'form-horizontal form-label-left']) !!}




                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Genel Ayarlar</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Google Ayarları</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Sosyal Medya</a>
                                    </li>



                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                        <div class="form-group">
                                            {{ Form::label('site_adi', 'Site Adı', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('site_adi',(isset($setting['site_adi']))?$setting['site_adi']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('telefon', 'Telefon', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('telefon',(isset($setting['telefon']))?$setting['telefon']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            {{ Form::label('faks', 'Faks', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('faks',(isset($setting['faks']))?$setting['faks']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('eposta', 'E-posta', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('eposta',(isset($setting['eposta']))?$setting['eposta']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('adres', 'Adres', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('adres',(isset($setting['adres']))?$setting['adres']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>


                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                        <div class="form-group">
                                            {{ Form::label('google_dogrulama', 'Google Doğrulama Kodu', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('google_dogrulama',(isset($setting['google_dogrulama']))?$setting['google_dogrulama']:'',['class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('google_analitik', 'Google Analitik Kodu', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::textarea('google_analitik',(isset($setting['google_analitik']))?$setting['google_analitik']:'',['rows'=>3,'class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('google_harita', 'Google Harita Kodu', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::textarea('google_harita',(isset($setting['google_harita']))?$setting['google_harita']:'',['rows'=>3,'class' => 'form-control col-md-7 col-xs-12']) }}

                                            </div>
                                        </div>



                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                                        <div class="form-group">
                                            {{ Form::label('fb', 'Facebook Sayfa Linki', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('fb',(isset($setting['fb']))?$setting['fb']:'',['class' => 'form-control col-md-7 col-xs-12']) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('tw', 'Twitter Sayfa Linki', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('tw',(isset($setting['tw']))?$setting['tw']:'',['class' => 'form-control col-md-7 col-xs-12']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('ins', 'Instagram Sayfa Linki', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('ins',(isset($setting['ins']))?$setting['ins']:'',['class' => 'form-control col-md-7 col-xs-12']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('ytb', 'Pinterest Sayfa Linki', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) }}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {{ Form::text('pin',(isset($setting['pin']))?$setting['pin']:'',['class' => 'form-control col-md-7 col-xs-12']) }}
                                            </div>
                                        </div>

                                    </div>




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
    <script src="{{asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>

@endsection