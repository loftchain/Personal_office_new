<label class="icoForm__label" for="birthday">{!! trans('home/kyc.kyc_dateOfBirth') !!}</label>
<div class="row no-gutters">
    <div class="col-3">
        <div class="icoForm__selectContainer">
            <select class="icoForm__select" id="birthday" name="day">
                <option value="">{!! trans('home/kyc.kyc_day') !!}   </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
        </div>
    </div>
    <div class="col-5">
        <div class="icoForm__selectContainer icoForm__selectContainer--margin">
            <select class="icoForm__select" name="month">
                <option value="">{!! trans('home/kyc.kyc_month') !!}</option>
                <option value="January">{!! trans('home/kyc.kyc_monthJanuary') !!}</option>
                <option value="February">{!! trans('home/kyc.kyc_monthFebruary') !!}</option>
                <option value="March">{!! trans('home/kyc.kyc_monthMarch') !!}</option>
                <option value="April">{!! trans('home/kyc.kyc_monthApril') !!}</option>
                <option value="May">{!! trans('home/kyc.kyc_monthMay') !!}</option>
                <option value="June">{!! trans('home/kyc.kyc_monthJune') !!}</option>
                <option value="July">{!! trans('home/kyc.kyc_monthJuly') !!}</option>
                <option value="August">{!! trans('home/kyc.kyc_monthAugust') !!}</option>
                <option value="September">{!! trans('home/kyc.kyc_monthSeptember') !!}</option>
                <option value="October">{!! trans('home/kyc.kyc_monthOctober') !!}</option>
                <option value="November">{!! trans('home/kyc.kyc_monthNovember') !!}</option>
                <option value="December">{!! trans('home/kyc.kyc_monthDecember') !!}</option>
            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="icoForm__selectContainer">
            <select class="icoForm__select" name="year">
                <option value="">{!! trans('home/kyc.kyc_year') !!}</option>
                @for($i = 1960; $i <= 2018; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
</div>