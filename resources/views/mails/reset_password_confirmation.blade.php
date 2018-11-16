<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="gradientLeft"></div>
<div class="gradientBottom"></div>
<div class="gradientRight"></div>
<div class="login modalFrame modalMessage">
    <div class="modalFrame__title">{!! trans('mails/mails.resetPasswordSubject_controller') !!}</div>
    <br>
    <div class="formControltext-center"><a class="btn"
                                           href="{{ route('home.kyc') }}">{!! trans('mails/mails.forgotButton') !!}</a></div>
</div>
</body>
</div>
