@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-4 offset-md-4">
            @include('layouts.errors')

            <div class="lead">
                {{ $title }}
                <hr/>
            </div>

            <form method="POST" action="" id="form">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for='birthday' class='col-sm-4 col-form-label'>Your birthday:</label>
                    <div class="col-sm-8">
                        <input type="date" id='birthday' name="birthday" class='form-control'>
                    </div>
                </div>

                <input type="submit" class='btn btn-primary'>
            </form>
        </div>
    </div>

@stop

@section('scripts')
    @parent
    {{-- validate form before submission --}}
    <script>
        $(function() {
            $('#form').submit(function(e) {
                // get the error container div selector
                $errorContainer = $('.error-container');
                // remove any existing errors within the error container div
                $errorContainer.empty();
                // hide the error container if not already hidden
                if($errorContainer.hasClass('d-none') == false) {
                    $errorContainer.addClass('d-none');
                }
                // initialize var holding form data
                var data = {
                    'birthday': $('#birthday').val()
                };
                // send ajax request to api backend requesting list of errors for put request
                $.ajax({
                    url: '{{ route('getStoreErrors') }}',
                    type: 'POST',
                    data: data,
                    async: false,
                    success: function(result) {
                        obj = result;
                        // convert json to object
                        // obj = JSON.parse(result);
                        // see if Errors property is available
                        if(obj.Errors) {
                            // check if Errors property has a positive array length
                            if(obj.Errors.length > 0) {
                                // halt form submission
                                e.preventDefault();
                                // error container remove class that hides element
                                $errorContainer.removeClass('d-none');
                                // initialize errors container
                                $errors = [];
                                // iterate over obj.Errors array, pushing each value to $errors array within <li> tags
                                for(var i=0; i<obj.Errors.length; i++) {
                                    $errors.push('<li>'+obj.Errors[i]+'</li>');
                                }
                                // set error container element the parent of the $errors list items
                                $errorContainer.html($errors);
                            } else {
                                // submit form to backend if no errors
                            }
                        }
                    }
                });
            });
        });
    </script>
@stop