@extends('backend.layouts.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Settings</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="general-settings-tab" data-bs-toggle="tab"
                                    href="#general-settings" role="tab" aria-controls="general-settings"
                                    aria-selected="true">General Settings</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="custom-settings-tab" data-bs-toggle="tab"
                                    href="#custom-settings" role="tab" aria-controls="custom-settings"
                                    aria-selected="false">Custom Settings</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="general-settings" role="tabpanel"
                                aria-labelledby="general-settings-tab">
                                <form class="my-3" action="{{ route('slider.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Site Name :</label>
                                            <input type="text" class="form-control" placeholder="Site Name"
                                                autocomplete="off" name="name" value="{{ old('name') }}" />
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Site Author</label>
                                            <input type="text" class="form-control" placeholder="Site Author"
                                                autocomplete="off" value="{{ old('author') }}" name="author" />
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Site Keywords</label>
                                            <textarea name="site-keywords" placeholder="Site Keywords" class="form-control" style="min-height: 80px;"
                                                id="">{{ old('site-keywords') }}</textarea>

                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Site Description</label>
                                            <textarea name="site-description" placeholder="Site Description" class="form-control"
                                                style="min-height: 80px;" id="">{{ old('site-description') }}</textarea>

                                        </div>
                                        <div class="col-xxl-12 col-xl-12 col-lg-12">
                                            <label class="form-label">Site Favicon</label>
                                            <div class="input-group">
                                                <label class="input-group-text" for="imageFiles"><i
                                                        class="bi bi-upload"></i></label>
                                                <input type="file" class="form-control" id="imageFiles"
                                                    name="imageFiles[]" accept="image/*" multiple>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Sorry!</strong> There were more problems with your HTML
                                        input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="custom-settings" role="tabpanel"
                                aria-labelledby="custom-settings-tab">
                                <form class="my-3" action="{{ route('slider.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Address</label>
                                            <textarea name="footer-text" class="form-control" placeholder="Address" style="min-height: 80px;"
                                            id="">{{ old('footer-text') }}</textarea>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Google Maps</label>
                                            <input type="tel" class="form-control" placeholder="Google Maps" autocomplete="off"
                                                value="{{ old('fax') }}" name="fax" />
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Phone</label>
                                            <input type="tel" class="form-control" placeholder="Phone" autocomplete="off"
                                                value="{{ old('phone') }}" name="phone" />
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Fax</label>
                                            <input type="tel" class="form-control" placeholder="Fax" autocomplete="off"
                                                value="{{ old('fax') }}" name="fax" />
                                        </div>

                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">E-mail</label>
                                            <input type="mail" class="form-control" placeholder="E-mail"
                                                autocomplete="off" value="{{ old('e-mail') }}" name="e-mail" />
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label" for="whatsapp-checkbox">Whatsapp Button</label>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="whatsapp-checkbox"
                                                    checked="">
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Footer Text</label>
                                            <textarea name="footer-text" class="form-control" style="min-height: 80px;"
                                                id="">{{ old('footer-text') }}</textarea>

                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Sorry!</strong> There were more problems with your HTML
                                        input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean ornare
                                    interdum
                                    viverra. Sed ut odio velit. Aenean eu diam
                                    dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum. Maecenas id
                                    sollicitudin ex. Cras in ex vestibulum,
                                    posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in cursus sem
                                    placerat ut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
