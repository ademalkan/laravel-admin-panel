@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12">
                <div class="page-title">
                    <h4>Blog</h4>
                </div>
                <div class="card h-unset">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card no-shadow">
                                    <div class="card-header">
                                        <h4 class="card-title">Article Edit Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="personal_validate" action="{{ route('blog.update', $data->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf

                                            <div class="row g-4">
                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Article Name</label>
                                                    <input type="text" class="form-control" placeholder="Slider Name"
                                                        autocomplete="off" name="name"
                                                        value="{{ $data->title ?? old('name') }}" />
                                                </div>

                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Release Date</label>
                                                    <input type="date" value="{{ date('Y-m-d',strtotime($data->published_date)) }}" class="form-control"
                                                        autocomplete="off"
                                                        name="published_date" />
                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select" name="category" id="categorySelect">
                                                        @foreach ($categories as $item)
                                                            <option {{ $item->id == $data->category_id }} value="{{$item->id}}">{{ $item->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                    <label class="form-label">Article Content</label>
                                                    <textarea name="content" class="form-control"
                                                        style="min-height: 80px;" placeholder="Slider Content"
                                                        id="">{{ $data->content ?? old('content') }}</textarea>

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
                                                @if ($data->getArticleImage->count() > 0)
                                                    <section class="section">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row gallery">
                                                                            @foreach ($data->getArticleImage as $item)
                                                                                <div
                                                                                    class="col-12 col-md-4 col-lg-3 mt-2  mb-2 gallery-items">
                                                                                    <a href="#" data-bs-toggle="modal"
                                                                                        data-bs-target="#galleryModal">
                                                                                        <img class="w-100 active"
                                                                                            src="{{ asset('image/' . $item->image) }}"
                                                                                            data-bs-target="#Gallerycarousel"
                                                                                            data-bs-slide-to="0">
                                                                                    </a>
                                                                                    <div class="delete-image"
                                                                                        onclick="deleteItem(this)"
                                                                                        img-id={{ $item->id }}>
                                                                                        <i class="bi bi-trash"></i>
                                                                                    </div>

                                                                                </div>
                                                                            @endforeach


                                                                        </div>

                                                                        <div class="modal fade" id="galleryModal"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="galleryModalTitle"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="galleryModalTitle">Loaded
                                                                                            Images
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <i data-feather="x"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                        <div id="Gallerycarousel"
                                                                                            class="carousel slide"
                                                                                            data-bs-ride="carousel">

                                                                                            <div class="carousel-inner">
                                                                                                @foreach ($data->getArticleImage as $index => $item)
                                                                                                    <div
                                                                                                        class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                                        <img class="d-block w-100"
                                                                                                            src="{{ asset('image/' . $item->image) }}">
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <a class="carousel-control-prev"
                                                                                                href="#Gallerycarousel"
                                                                                                role="button" type="button"
                                                                                                data-bs-slide="prev">
                                                                                                <span
                                                                                                    class="carousel-control-prev-icon"
                                                                                                    aria-hidden="true"></span>
                                                                                            </a>
                                                                                            <a class="carousel-control-next"
                                                                                                href="#Gallerycarousel"
                                                                                                role="button"
                                                                                                data-bs-slide="next">
                                                                                                <span
                                                                                                    class="carousel-control-next-icon"
                                                                                                    aria-hidden="true"></span>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                @endif


                                                <div class="col-12">
                                                    <button class="btn btn-success pl-5 pr-5 waves-effect">
                                                        Update
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

@section('js')
    <script>
        function deleteItem(e) {
            console.log(e);
            Swal.fire({
                title: 'Are you sure you want to delete it permanently?',
                showCancelButton: "Cancel",
                cancelButtonText: "Cancel",
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    const image_id = e.getAttribute("img-id");
                    const slider_id = window.location.pathname.split("/")[3];

                    // console.log(image_id)
                    // console.log(slider_id)
                    const token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: `delete-image`,
                        type: 'POST',
                        data: {
                            "image_id": image_id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            // console.log(res);
                            if (res.status == 201) {
                                Swal.fire('Deletion successful', '', 'success')
                                console.log(e)
                                e.closest(".gallery-items").remove();
                            } else {
                                // console.log("hata");
                                Swal.fire('An error occurred during the operation !', '', 'danger')

                            }
                        }
                    });
                }
            })

        }
    </script>
@endsection
