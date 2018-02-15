<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} </title>

    <link href="{{ asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('backend/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('backend/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
<div>


    <div class="login_wrapper">



            <div class="animate form login_form">
            <section class="login_content">
                {!! Form::open(['route' => 'admin.forgot','data-parsley-validate novalidate']) !!}

                    <h1>Şifre Hatırlatma</h1>
                    @if (session('error'))
                        <p class="alert alert-danger">{{ session('error') }}</p>
                    @endif

                    @if (session('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif

                    <div>
                        {{ Form::email('email','',['class' => 'form-control','placeholder'=>'E-posta Adresiniz','required']) }}

                    </div>

                    <div>
                        <input type="submit" class="btn btn-default submit" value="Şifremi Sıfırla"/>
                        <a href="{{ route('admin.login') }}" class="to_register"> Giriş Yapın </a>
                    </div>

                    <div class="clearfix"></div>


                {!! Form::close() !!}
            </section>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{ asset('backend/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/vendors/parsleyjs/dist/i18n/tr.js')}}"></script>
</body>
</html>
