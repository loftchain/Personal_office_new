@extends('layouts.app')

@section('content')
    <div class="gradientLeft"></div>
    <div class="gradientBottom"></div>
    <div class="gradientRight"></div>
    <div class="container">
        <div class="forSlideMenu">
            <div class="cabinetHolder">
                <div class="sidebar jsSidebar">
                    <div class="userInfo">
                        <div class="userInfo__avatar"><a class="userInfo__avatarLink" href="#"><img class="userInfo__avatarImage" src="img/avatar.jpg" alt="Name Surname"></a></div>
                        <div class="userInfo__text">
                            <div class="userInfo__textItem">{{ Auth::user()->name }}</div>
                            <div class="userInfo__textItem">Status: Not verified</div>
                            <div class="userInfo__textItem">Token amount: 876 LSD</div>
                        </div>
                    </div>
                    <div class="mainMenu">
                        <ul class="mainMenu__list">
                            <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetIco1.html">ICO</a></li>
                            <li class="mainMenu__item mainMenu__item--active"><a class="mainMenu__link" href="cabinetKYC.html">Verification</a></li>
                            <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetBuyTokens.html">Buy tokens</a></li>
                            <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetReferral.html">Referral Program</a></li>
                            <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetSettings.html">Settings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="workArea jsWorkArea">
                    <div class="mobileMenuBtn">
                        <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
                    </div>
                    <div class="messageTop">Unfortunately your profile is not verified yet.</div>
                    <div class="scrollHolder">
                        <div class="content" id="buyTokens">
                            <div class="blockHolder">
                                <div class="raisedContainer">
                                    <div class="basicBlock basicBlock--single">
                                        <div class="basicBlock__content">
                                            <div class="basicBlock__title text-center">Purchase of tokens</div>
                                            <div class="basicBlock__subtitle text-center">Choose which currency you want to invest in</div>
                                            <div class="cryptoSelector">
                                                <button class="cryptoSelector__item cryptoSelector__item--active">Etherium</button>
                                                <button class="cryptoSelector__item">Bitcoin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blockHolder">
                                <div class="raisedContainer">
                                    <div class="basicBlock">
                                        <div class="basicBlock__content">
                                            <form class="loginForm icoForm" action="#">
                                                <div class="formControl">
                                                    <label class="icoForm__label">ETH wallet  for investing and receiving tokens</label>
                                                    <input class="icoForm__input icoForm__input--pencil" type="text" name="ethWallet"><span class="icoForm__pencil"></span>
                                                </div>
                                                <div class="formControl">
                                                    <label class="icoForm__label">Enter your BTC wallet for investment</label>
                                                    <input class="icoForm__input icoForm__input--pencil" type="text" name="btcWallet"><span class="icoForm__pencil"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="raisedContainer">
                                    <div class="basicBlock basicBlock">
                                        <div class="basicBlock__content">
                                            <form class="loginForm icoForm" action="#">
                                                <div class="row">
                                                    <div class="col-md-3 align-self-top text-center"><img class="qrCode" alt="qr" src="img/qr.jpg"></div>
                                                    <div class="col-md-9 align-self-top">
                                                        <div class="formControl formControl--noMargin">
                                                            <input class="icoForm__input icoForm__input--canCopy" type="text" v-model="invsetmentWalletETH" name="ethWallet" id="ethWallet"><span class="icoForm__copy" v-on:click="copyToBuffer"> </span>
                                                        </div>
                                                        <div class="minumudDeposit">Minimum deposit amount: minumumDeposit ETH</div>
                                                        <div class="setGas">Set GAS: gas</div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blockHolder">
                                <div class="raisedContainer">
                                    <div class="basicBlock basicBlock--single">
                                        <div class="basicBlock__content">
                                            <div class="basicBlock__title text-center">tRANSACTIONS</div>
                                            <div class="basicBlock__subtitle text-center">Thank you for your participation! You can see your transactions</div>
                                            <div class="infoBtn"><a class="btn btn--small" href="#">h5723882302832cn8399c2</a></div>
                                            <div class="dataTable">
                                                <table class="dataTable__list">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Currency</th>
                                                        <th>Token</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    <tr class="dataTable__error">
                                                        <td>21.09.2018</td>
                                                        <td>-10 ETH</td>
                                                        <td>+34000 LTD</td>
                                                        <td>False</td>
                                                    </tr>
                                                    <tr class="dataTable__success">
                                                        <td>21.09.2018</td>
                                                        <td>-10 ETH</td>
                                                        <td>+34000 LTD</td>
                                                        <td>Success</td>
                                                    </tr>
                                                    <tr class="dataTable__summary">
                                                        <td colspan="2"><span class="dataTable__address"><strong>To</strong>: h5723882302832cn8399c2</span></td>
                                                        <td colspan="2"><strong>Info: </strong><a class="dataTable__link" href="#">h5723882302832cn8399c2</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
