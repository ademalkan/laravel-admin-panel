@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12">
                <div class="page-title">
                    <h4>Pages</h4>
                </div>
                <div class="card h-unset">
                    {{-- <div class="card-header">
            <div class="settings-menu">
              <a href="{{ route("page.index") }}">page Listesi</a>
            </div>
          </div> --}}
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card no-shadow">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Page Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="" action="{{ route('page.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Page Name</label>
                                                    <input type="text" class="form-control" placeholder="Page Name"
                                                        autocomplete="off" name="name" value="{{ old('name') }}" />
                                                </div>

                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Page Description</label>
                                                    <textarea name="description" class="form-control"
                                                        style="min-height: 80px;" placeholder="Page Description"
                                                        id="">{{ old('description') }}</textarea>

                                                </div>
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Page Image</label>
                                                    <div class="input-group">
                                                        <label class="input-group-text" for="image"><i
                                                                class="bi bi-upload"></i></label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image" accept="image/*">
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
