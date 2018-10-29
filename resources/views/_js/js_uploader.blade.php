<script>
    var galleryUploader = new qq.FineUploader({
        element: document.getElementById("fine-uploader-gallery"),
        template: 'qq-template-gallery',
        request: {
            endpoint: '{{ route('home.kyc.upload') }}',
        },
        thumbnails: {
            placeholders: {
                waitingPath: '{{ asset('img/placeholders/waiting-generic.png') }}',
                notAvailablePath: '{{ asset('img/placeholders/not_available-generic.png') }}'
            }
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
        }
    });
</script>