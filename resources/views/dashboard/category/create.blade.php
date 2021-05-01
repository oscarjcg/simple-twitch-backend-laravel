@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div id="status"></div>

        <div class="card-body"><h5 class="card-title">Create category</h5>
            <form id="create-form" class="needs-validation">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="name" class="">Name</label>
                            <input name="name" id="name" placeholder="Category name" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="position-relative row form-group">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input name="image" id="image" type="file" class="form-control-file">
                        <small class="form-text text-muted">Square image</small>
                    </div>
                </div>

               <button class="mt-2 btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            event.preventDefault();
                            event.stopPropagation();

                            // Api request. Create channel
                            var f = $('#create-form')[0];
                            var formData = new FormData(f);

                            $.ajax({
                                type: "POST",
                                url: window.location.origin + "/api/categories",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function( msg ) {
                                    console.log( msg );

                                    // Success alert
                                    $('#status').append(`
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> Category created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    console.log(xhr.responseText);

                                    var json = JSON.parse(xhr.responseText)
                                    // Error alert
                                    $('#status').append(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> ` + json.message + `
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`);
                                }
                            });


                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


@endsection
