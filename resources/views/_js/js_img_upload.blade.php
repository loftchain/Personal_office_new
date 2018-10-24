<script>

    String.prototype.trunc = String.prototype.trunc ||
        function (n) {
            return (this.length > n) ? this.substr(0, n - 1) + '...' : this;
        };

    $(function(){


        var ul = $('#upload ul');

        $('#drop a').click(function(){
            // Simulate a click on the file input button
            // to show the file browser dialog
            $(this).parent().find('input').click();
        });

        // Initialize the jQuery File Upload plugin
        $('#upload').fileupload({

            // This element will accept file drag/drop uploading
            dropZone: $('#drop'),

            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:
            add: function (e, data) {


                // Append the file name and file size
                let fileName = (data.files[0].name.length < 15) ? data.files[0].name : data.files[0].name.trunc(15);


                // Automatically upload the file once it is added to the queue
                var jqXHR = data.submit();
                setTimeout(function () {
                    location.reload();

                }, 500)

            },

            fail:function(e, data){
                // Something has gone wrong!
                data.context.addClass('error');
            }

        });


        // Prevent the default action when a file is dropped on the window
        $(document).on('drop dragover', function (e) {
            e.preventDefault();
        });

        // Helper function that formats the file sizes
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }

    });

    $(document).ready(() => {
        if ($('.doc-container').is(':empty') || !$('.terms-checkbox').is(':checked')) {
            $('.a2-form__sbmt-btn').prop('disabled', true);
        } else {
            $('.a2-form__sbmt-btn').prop('disabled', false);
        }
    });

    $('.doc-container').change(function () {
        if (!$(this).is(':empty') && $('.terms-checkbox').is(':checked')) {
            $('.a2-form__sbmt-btn').prop('disabled', false);
        } else {
            $('.a2-form__sbmt-btn').prop('disabled', true);
        }
    });

    $('.terms-checkbox').change(function () {
        if (!$('.doc-container').is(':empty') && $(this).is(':checked')) {
            $('.a2-form__sbmt-btn').prop('disabled', false);
        } else {
            $('.a2-form__sbmt-btn').prop('disabled', true);
        }
    });

</script>