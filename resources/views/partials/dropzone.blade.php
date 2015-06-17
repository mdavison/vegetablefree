@section('styles')
    <link rel="stylesheet" href="/css/dropzone/dropzone.min.css">
    <style>
        .dropzone { border: 2px dashed #0087F7; border-radius: 5px; background: white; }
    </style>
@stop

@section('scripts')
    <script src="/js/vendor/dropzone.min.js"></script>
    <script>
        (function() {
            Dropzone.options.myDropzone = false;

            var recipe_id = $("#recipe_id").val();
            var numPhotos = $(".thumbnail").length;
            var maxPhotos = 5 - numPhotos;
            var csrf_token = $('.dropzone input[name=_token]').val();

            var myDropzone = new Dropzone(".dropzone",
                    {
                        url: "{{ url('photos/store') }}",
                        dictDefaultMessage: 'Click or drag photos here to upload.',
                        addRemoveLinks: true,
                        maxFilesize: 3, // MB
                        maxFiles: maxPhotos,
                        acceptedFiles: "image/*",
                        dictRemoveFile: 'Remove',
                        headers: { "recipe_id": recipe_id }
                    });

            // Add existing photos to preview
            if (recipe_id){
                $.post( "{{ url('recipes/photos') }}",
                    {
                        _token: csrf_token,
                        id: recipe_id
                    },
                    function( data ) {
                        for (i=0; i < data.length; i++) {
                            var file = {name: data[i].filename, size: 12345678};
                            var filepath = "/photos/" + recipe_id + "/" + data[i].filename;

                            myDropzone.emit("addedfile", file);
                            myDropzone.emit("thumbnail", file, filepath);
                            myDropzone.emit("complete", file);
                        }
                    }, "json");
            }

            // Remove a file
            myDropzone.on("removedfile", function(file) {
                // If file status is error, don't delete it because it's not there
                if (file.status !== 'error') {
                    var photos_token = {{ $photos_token }};

                    $.post( "{{ url('photos/remove') }}",
                            {
                                _token: csrf_token,
                                photos_token: photos_token,
                                filename: file.name,
                                id: recipe_id
                            },
                            function( data ) {
                                //console.log( data );
                            }, "json");
                }
            });

        })();
    </script>


@stop