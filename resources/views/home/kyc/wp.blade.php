<div class="basicBlock__content">
    <div class="basicBlock__title text-center">{!! trans('home/kyc.whitePaper_title') !!}</div>
    <div class="basicBlock__subtitle text-center">{!! trans('home/kyc.whitePaper_desc') !!}</div>
    <div class="btnConainer text-center">
      <a class="btn btn--whitePaper btn--small" href="{{ asset('/Mitoshi_Token_Sale_Agreement.docx') }}" target="_blank">
        {!! trans('home/kyc.agreement_btn') !!}
      </a>
    </div>
    <div class="agreement text-center">
        <input class="checkbox" type="checkbox" name="agreement" id="agreement" {{ $personal ? 'checked' : '' }}>
        <label for="agreement">{!! trans('home/kyc.whitePaper_checkBox') !!}</label>
    </div>
</div>