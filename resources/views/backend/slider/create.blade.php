@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12">
                <div class="page-title">
                    <h4>Slider</h4>
                </div>
                <div class="card h-unset">
                    {{-- <div class="card-header">
            <div class="settings-menu">
              <a href="{{ route("slider.index") }}">Slider Listesi</a>
            </div>
          </div> --}}
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card no-shadow">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Slider Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="" action="{{ route('slider.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Slider Name</label>
                                                    <input type="text" class="form-control" placeholder="Slider Name"
                                                        autocomplete="off" name="name" value="{{ old('name') }}" />
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Slider Title</label>
                                                    <input type="text" class="form-control" placeholder="Slider Title"
                                                        autocomplete="off" value="{{ old('title') }}" name="title" />
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Slider Subtitle</label>
                                                    <input type="text" class="form-control" placeholder="Slider Subtitle"
                                                        autocomplete="off" value="{{ old('subtitle') }}"
                                                        name="subtitle" />
                                                </div>
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Slider Description</label>
                                                    <textarea name="description" class="form-control"
                                                        style="min-height: 80px;" placeholder="Slider Description"
                                                        id="">{{ old('description') }}</textarea>

                                                </div>
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Slider Images</label>
                                                    <div class="input-group">
                                                        <label class="input-group-text" for="imageFiles"><i
                                                                class="bi bi-upload"></i></label>
                                                        <input type="file" class="form-control" id="imageFiles"
                                                            name="imageFiles[]" accept="image/*" multiple>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="btn btn-success pl-5 pr-5 waves-effect">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger mt-3">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
