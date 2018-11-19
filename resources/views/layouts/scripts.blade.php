<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('js/jquery/jquery.fileupload.js') }}"></script>
<script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/fancybox/jquery.fancybox.min.js') }}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="{{ asset('js/ico.js') }}"></script>
@include('_js.js_custom_validation')
@include('_js.js_main_menu')
@include('_js.js_loader_cloak')

@if(isset($data) && \Illuminate\Support\Facades\Route::current()->getName() == 'home.index')
    @include('_js.js_widget')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    @include('_js.js_chart')
@endif
