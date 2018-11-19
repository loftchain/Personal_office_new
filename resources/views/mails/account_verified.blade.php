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
        width: 50px;
        height: 50px;
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: 100%;
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
        padding: 20px 20px;
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
