@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12">
                <div class="page-title">
                    <h4>Blog</h4>
                </div>
                <div class="card h-unset">
                    {{-- <div class="card-header">
            <div class="settings-menu">
              <a href="{{ route("blog.index") }}">blog Listesi</a>
            </div>
          </div> --}}
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card no-shadow">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Article Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="" action="{{ route('blog.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Article Title</label>
                                                    <input type="text" class="form-control" placeholder="Article Title"
                                                        autocomplete="off" name="title" value="{{ old('title') }}" />
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Release Date</label>
                                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                                        placeholder="Article Title" autocomplete="off"
                                                        name="published_date" />
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select" name="category" id="categorySelect">
                                                        @foreach ($categories as $item)
                                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Article Content</label>
                                                    <textarea name="content" class="form-control"
                                                        style="min-height: 120px;" placeholder="Article Content"
                                                        id="">{{ old('content') }}</textarea>

                                                </div>
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Article Image</label>
                                                    <div class="input-group">
                                                        <label class="input-group-text" for="imageFiles"><i
                                                                class="bi bi-upload"></i></label>
                                                        <input type="file" class="form-control" id="imageFiles"
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
