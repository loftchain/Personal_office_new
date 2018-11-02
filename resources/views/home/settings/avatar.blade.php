<div class="avatarSettings">
    <div class="avatarSettings__imageHolder"><img class="avatarSettings__image" src="{{ Auth::user()->img ? route('settings.get.avatar', Auth::user()->img) : asset('img/avatar.png') }}">
        <form id="upload" class="icoForm icoForm--noMargin" action="{{ route('home.settings.upload.avatar') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="drop">

                <label class="avatarSettings__uploadBtn" for="avatarUpload">
                    <input class="hiddenInput" type="file" id="avatarUpload" name="avatar" multiple />
                </label>
            </div>
        </form>
    </div>
    <div class="avatarSettings__note">{!! trans('home/settings.uploadPhoto') !!}</div>
</div>