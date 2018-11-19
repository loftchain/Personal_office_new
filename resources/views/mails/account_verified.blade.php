<style>
    .wrapper {
        background-color: #fff;
        font-family: Arial sans-serif;
        display: block;
        flex-direction: column !important;
        margin: 0 auto;
        width: 100%;
        min-height: 550px;
    }

    .img-container {
        text-align: center;
        margin: 0 auto;
        background-size: cover;
        width: 55%;
        height: 14%;
        overflow: hidden;
    }

    .img-container img {
        padding: 15px;
        height: 60%;
        width: 60%;
        max-width: 100%;
    }

    .rect {
        margin: 0 auto;
        width: 60%;
        background-color: #fff;
        text-align: center;
        color: #000;
    }

    .rect div {
        line-height: 24px;
        padding: 40px 40px;
        font-size: 18px;
    }

    .rect span a{
        color: #1D52A7;
        font-size: 16px;
    }

    .bottom {
        text-align: center;
        margin: 0 auto;
        width: 100%;
        padding-left: 5%;
        padding-top: 2%;
        font-size: 12px;
        color: #4b4b4b;
    }
</style>
<div class="wrapper">
    <div class="img-container">
        <img src="https://mitoshi.io/images/logo.png" alt="" border="0"/>
    </div>
    <div class="rect">
        <div>
            <h3>
                 <span>
                    {!! trans('mails/mails.vTitle') !!}
                    <br>
                    <a class="btn" href="{{ route('home.tokens') }}">{!! trans('mails/mails.vButton') !!}</a>
                 </span>
            </h3>
        </div>
    </div>

    <div class="bottom">
        <p>{!! __('mails/mails.doNotReply_p') !!}<br>
            {!! __('mails/mails.contactUs_p') !!}</p>
    </div>
</div>
