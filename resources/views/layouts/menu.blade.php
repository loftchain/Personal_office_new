@if(Auth::user()->admin == 1)
    <div class="sidebar jsSidebar">
        <div class="userInfo">
            <div class="userInfo__text">
                <div class="userInfo__textItem">Admin</div>
            </div>
        </div>
        <div class="mainMenu">
            <ul class="mainMenu__list">
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('admin.kyc') }}">{!! trans('home/menu.aVerification') !!}</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('admin.history') }}">{!! trans('home/menu.aHistory') !!}</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('admin.referral') }}">{!! trans('home/menu.aReferrals') !!}</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('admin.transaction') }}">{!! trans('home/menu.aTransactions') !!}</a></li>
            </ul>
        </div>
        <a class="sidebar__logout" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
    </div>

@else
    <div class="sidebar jsSidebar">
        <div class="userInfo">
            <div class="userInfo__avatar">
                <a class="userInfo__avatarLink" href="{{ route('home.settings') }}">
                    <img class="userInfo__avatarImage" src="{{ Auth::user()->img ? route('settings.get.avatar', Auth::user()->img) : asset('img/avatar.png') }}" alt="Name Surname">
                </a>
            </div>
            <div class="userInfo__text">
                <div class="userInfo__textItem">{{ Auth::user()->name }}</div>
                <div class="userInfo__textItem">{!! trans('home/menu.status') !!}: {{ !Auth::user()->confirmed ? trans('home/menu.verified1') : ''}} {!! trans('home/menu.verified') !!}</div>
                <div class="userInfo__textItem">{!! trans('home/menu.tokenAmount') !!} {{ with(new \App\Services\WalletService())->getMyTokensFromApi() ?? '0'}} {{ env('TOKEN_NAME') }}</div>
            </div>
        </div>
        <div class="mainMenu">
            <ul class="mainMenu__list">
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.index') }}">ICO</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.kyc') }}">{!! trans('home/menu.verification') !!}</a> </li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.tokens') }}">{!! trans('home/menu.buyTokens') !!}</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.referral') }}">{!! trans('home/menu.referralProgram') !!}</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.settings') }}">{!! trans('home/menu.settings') !!}</a></li>
            </ul>
        </div>
        <footer class="page-footer page-footer--menu">
            @include('layouts.footer')
        </footer>
        <a class="sidebar__logout" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
    </div>

@endif
