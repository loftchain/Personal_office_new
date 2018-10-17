@if(Auth::user()->admin == 1)
    <div class="sidebar jsSidebar">
        <div class="userInfo">
            <div class="userInfo__text">
                <div class="userInfo__textItem">Admin</div>
            </div>


        </div>
        <div class="mainMenu">
            <ul class="mainMenu__list">
                <li class="mainMenu__item mainMenu__item--active"><a class="mainMenu__link"
                                                                     href="{{ route('admin.kyc') }}">Verification</a>
                </li>
            </ul>
        </div>
    </div>
@else
    <div class="sidebar jsSidebar">
        <div class="userInfo">
            <div class="userInfo__avatar"><a class="userInfo__avatarLink" href="{{ route('home.settings') }}"><img
                            class="userInfo__avatarImage"
                            src="{{ Auth::user()->img ? asset('storage/' . Auth::user()->img) : asset('img/avatar.png') }}"
                            style="width: 75px; height: 75px" alt="Name Surname"></a>
            </div>
            <div class="userInfo__text">
                <div class="userInfo__textItem">{{ Auth::user()->name }}</div>
                <div class="userInfo__textItem">Status: {{ !Auth::user()->confirmed ? 'Not ' : ''}} verified</div>
                <div class="userInfo__textItem">Token amount: 876 LSD</div>
            </div>
        </div>
        <div class="mainMenu">
            <ul class="mainMenu__list">
                <li class="mainMenu__item mainMenu__item--active"><a class="mainMenu__link"
                                                                     href="{{ route('home.index') }}">ICO</a>
                </li>
                <li class="mainMenu__item"><a class="mainMenu__link"
                                              href="{{ route('home.kyc') }}">Verification</a>
                </li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.tokens') }}">Buy
                        tokens</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.referral') }}">Referral
                        Program</a></li>
                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.settings') }}">Settings</a>
                </li>
            </ul>
        </div>
    </div>
@endif
