@section('styles')
    <link rel="stylesheet" href="/css/dropzone/dropzone.min.css">
    <style>
        .dropzone { border: 2px dashed #0087F7; border-radius: 5px; background: white; }
    </style>
@stop

@section('scripts')
    <script src="/js/dropzone/dropzone.min.js"></script>
    <script>
        Dropzone.options.myDropzone = false;
        var myDropzone = new Dropzone(".dropzone",
                {
                    url: "{{ url('photos/store') }}",
                    dictDefaultMessage: 'Click or drag photos here to upload.',
                    //addRemoveLinks: true,
                    maxFilesize: 2, // MB
                    maxFiles: 5,
                    acceptedFiles: "image/*"
                    //dictRemoveFile: 'Remove'
                });

        // Remove a file
        // Abandoning this for now:
        // If the same file was uploaded more than once, removing one of them in the UI will remove
        // ALL of them on the server but will not reflect that in the UI. No way to match the photo
        // the user clicked on with the one on the server
        myDropzone.on("removedfile", function(file) {
            var csrf_token = $('.dropzone input[name=_token]').val();
            var photos_token = {{ $photos_token }};
            $.post( "{{ url('photos/remove') }}",
                    {
                        _token: csrf_token,
                        photos_token: photos_token,
                        filename: file.name,
                        filesize: file.size  },
                    function( data ) {
                        //console.log( data );
            }, "json");
        });

    </script>
@stop