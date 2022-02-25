@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Blog</h4>
                            <div class="">
                                <a href="{{ route('blog.archive') }}" class="btn btn-sm btn-info">Archive List</a>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#categoryModalForm">
                                    Category
                                </button>
                                <a href="{{ route('blog.create') }}" class="btn btn-sm btn-success">New Article</a>
                            </div>
                        </div>
                        @if ($data->count() == 0)
                            <div class="card-body">
                                <div class="alert alert-info text-center">
                                    <h3>Oops!</h3> No article have been created yet.
                                    <a class="hover-underline" href="{{ route('blog.create') }}">Create now ! </a>
                                </div>
                            </div>
                        @endif


                        @if ($data->count() > 0)
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped responsive-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Article Name</th>
                                                <th>Slug</th>
                                                <th>Release Time</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody class="sortable">
                                            @foreach ($data as $item)
                                                <tr blog-tr={{ $item->id }}>
                                                    <td>
                                                        <div class="move">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" height="32px"
                                                                style="enable-background:new 0 0 32 32;" version="1.1"
                                                                viewBox="0 0 32 32" width="18px" xml:space="preserve">
                                                                <g id="Layer_1" />
                                                                <g id="move">
                                                                    <g>
                                                                        <polygon
                                                                            points="18,20 18,26 22,26 16,32 10,26 14,26 14,20   "
                                                                            style="fill:#4E4E50;" />
                                                                        <polygon
                                                                            points="14,12 14,6 10,6 16,0 22,6 18,6 18,12   "
                                                                            style="fill:#4E4E50;" />
                                                                        <polygon
                                                                            points="12,18 6,18 6,22 0,16 6,10 6,14 12,14   "
                                                                            style="fill:#4E4E50;" />
                                                                        <polygon
                                                                            points="20,14 26,14 26,10 32,16 26,22 26,18 20,18   "
                                                                            style="fill:#4E4E50;" />
                                                                    </g>
                                                                </g>
                                                            </svg>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="danger-arrow">
                                                            {{ $item->title }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $item->slug }}
                                                    </td>
                                                    <td>
                                                        {{ $item->published_date <= date('Y-m-d H:i:s')? 'Published': \Carbon\Carbon::parse($item->published_date)->diffForHumans() }}
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" blog-id={{ $item->id }}
                                                                onchange="statusChangeHandler(this)"
                                                                blog-status="{{ $item->status }}" type="checkbox"
                                                                name="status" {{ $item->status == 1 ? 'checked' : '' }}>

                                                        </div>

                                                    </td>

                                                    <td>
                                                        <a href="{{ route('blog.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                        <a type="button" data-id="{{ $item->id }}"
                                                            onclick="deleteItem(this)"
                                                            class="btn btn-sm btn-danger">Archive</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            @if ($data->count() > 0)
                                <div class="card-footer">
                                    {{ $data->links() }}
                                </div>
                            @endif
                        @endif






                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login form Modal -->
    <div class="modal fade text-left" id="categoryModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Categories </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="new-category mb-2">
                        <label>New Category</label>
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" name="category"
                                placeholder="Category Name">
                            <button class="btn btn-success" onclick="createCategory(this)" type="button"
                                id="button-addon1">Add</button>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Category Name</th>
                                <th>Options</th>
                            </thead>
                            <tbody category-body>
                                @forelse ($categories as $key => $category)
                                    <tr category-id={{ $category->id }}>
                                        <td>
                                            <input class="form-control" type="text" value="{{ $category->name }}"
                                                name="name">
                                        </td>
                                        <td>
                                            <button onclick="updateCategory(this)"
                                                class="btn btn-sm btn-primary">Update</button>
                                            <button onclick="deleteCategory(this)"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                @empty
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .ui-state-highlight {
            background-color: #3fbcde1f;
            border-color: #3fbcde1f;
            height: 40px;
        }

        .move:hover {
            cursor: move;
        }

    </style>
@endsection

@section('js')
    <script>
        $(function() {
            $(".sortable").sortable({
                placeholder: "ui-state-highlight",
                handle: ".move",
                stop: function() {
                    const orderArray = [];
                    $(".sortable").find("[blog-tr").map((key, event) => {
                        console.log(key, event)
                        let blogID = event.getAttribute("blog-tr")
                        let index = key
                        if (blogID) {
                            data = {
                                id: blogID,
                                order: index
                            }
                            orderArray.push(data)
                        }
                    })
                    postData = {
                        _token: "{{ csrf_token() }}",
                        data: orderArray,
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{ route('blog.orderChangeHandler') }}",
                        data: postData,
                        success: function(response) {
                            if (response.status == 201) {
                                Toastify({
                                    text: response.message,
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "#4fbe87",
                                }).showToast();
                            } else {
                                Toastify({
                                    text: response.message,
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "warning",
                                }).showToast();
                            }
                        }
                    });
                }
            });
        });

        function statusChangeHandler(e) {
            const statusHandler = e.getAttribute("blog-status")
            const blogIdHandler = e.getAttribute("blog-id")
            // console.log(statusHandler);
            const status = statusHandler == 1 ? 0 : 1;
            e.setAttribute("isStatus", status)
            data = {
                _token: "{{ csrf_token() }}",
                id: blogIdHandler,
                status: status
            }
            $.ajax({
                type: "POST",
                url: "{{ route('blog.statusChangeHandler') }}",
                data: data,
                success: function(response) {
                    if (response.status == 201) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "#4fbe87",
                        }).showToast();
                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "warning",
                        }).showToast();
                    }
                }
            });

        }

        function deleteItem(e) {

            Swal.fire({
                title: 'Are you sure you want to archive?',
                showCancelButton: "Cancel",
                cancelButtonText: "Cancel",
                confirmButtonText: 'Archive',
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(e).data("id");
                    // console.log(id);
                    const token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "blog/" + id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.status == 201) {
                                Swal.fire('Archiving successful !', '', 'success')
                                e.closest("tr").remove();
                            } else {
                                // console.log("hata");
                                Swal.fire('An error occurred during the operation !', '', 'danger')

                            }
                        }
                    })
                }
            })

        }

        function createCategory(e) {
            const category = $(e).siblings("input").val();
            const data = {
                _token: "{{ csrf_token() }}",
                name: category
            }
            $.ajax({
                type: "POST",
                url: "{{ route('category.store') }}",
                data: data,
                success: function(response) {
                    if (response.status == 201) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "#4fbe87",
                        }).showToast();
                        $("[category-body]").append(`<tr category-id=${response.id}>
                                        <td>
                                            <input class="form-control" type="text" value="${response.category}" name="name">
                                        </td>
                                        <td>
                                            <button onclick="updateCategory(this)" class="btn btn-sm btn-primary">Update</button>
                                            <button onclick="deleteCategory(this)" class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>`)
                        $(e).siblings("input").val('');
                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "warning",
                        }).showToast();
                    }
                }
            });
        }

        function updateCategory(e) {
            const id = e.closest("tr").getAttribute("category-id");
            const inputVal = $(e).closest("tr").find("input").val();
            const data = {
                _token: "{{ csrf_token() }}",
                id: id,
                value: inputVal
            }
            $.ajax({
                type: "PATCH",
                url: `blog/category/update/` + id,
                data: data,
                success: function(response) {
                    if (response.status == 201) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "#4fbe87",
                        }).showToast();

                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "warning",
                        }).showToast();
                    }
                }
            });
        }

        function deleteCategory(e) {
            const id = e.closest("tr").getAttribute("category-id");
            const data = {
                _token: "{{ csrf_token() }}",
                id: id
            }
            $.ajax({
                type: "DELETE",
                url: `blog/category/delete/` + id,
                data: data,
                success: function(response) {
                    if (response.status == 201) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "#4fbe87",
                        }).showToast();
                        e.closest("tr").remove();
                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            close: true,
                            backgroundColor: "warning",
                        }).showToast();
                    }
                }
            });
        }
    </script>
@endsection
