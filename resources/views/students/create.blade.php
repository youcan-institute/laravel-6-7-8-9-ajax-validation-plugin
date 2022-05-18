@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Student') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('student.store') }}" id="storeStudent"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" />
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="gender" class="col-md-4 col-form-label text-md-end">Gender</label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" value="male" type="radio" name="gender" id="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="contact" class="col-md-4 col-form-label text-md-end">Contact</label>
                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control" name="contact" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" />
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Student') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let formID = 'storeStudent';
            $(`#${formID}`).on('submit', function(e) {
                e.preventDefault();
                validateFormFields({
                    formID
                }, this);
            })
        });
    </script>
@endsection
