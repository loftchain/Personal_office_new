<div class="basicBlock__content">
    <div class="basicBlock__title text-center">{!! trans('home/kyc.whitePaper_title') !!}</div>
    <div class="basicBlock__subtitle text-center">{!! trans('home/kyc.whitePaper_desc') !!}</div>
    <div class="btnConainer text-center"><a class="btn btn--whitePaper btn--small" href="{{ asset('storage/Mitoshi_Whitepaper_2018.pdf') }}" target="_blank">{!! trans('home/kyc.whitePaper_btn') !!}</a></div>
    <div class="agreement text-center">
        <input class="checkbox" type="checkbox" name="agreement" id="agreement" {{ $personal ? 'checked' : '' }}>
        <label for="agreement">{!! trans('home/kyc.whitePaper_checkBox') !!}</label>
    </div>
</div>