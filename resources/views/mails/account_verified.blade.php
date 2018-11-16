<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="gradientLeft"></div>
<div class="gradientBottom"></div>
<div class="gradientRight"></div>
<div class="login modalFrame modalMessage">
    <div class="modalFrame__title">{!! trans('mails/mails.vTitle') !!}</div>
    <br>
    <div class="formControltext-center"><a class="btn" href="{{ route('home.tokens') }}">{!! trans('mails/mails.vButton') !!}</a></div>
</div>
</body>
