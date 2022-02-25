@extends("backend.layouts.master")
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Archived Slider List</h4>
                            <div class="">
                                <a href="{{ route('slider.index') }}" class="btn btn-sm btn-info">Turn Back</a>
                            </div>
                        </div>
                        @if ($data->count() == 0)
                            <div class="card-body">
                                <div class="alert alert-info text-center">
                                    <h3>Oops!</h3> No sliders have been archived yet.
                                    <a class="hover-underline" href="{{ route('slider.index') }}">Turn back ! </a>
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
                                                <th>Slider Name</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody class="sortable">


                                            @foreach ($data as $item)
                                                <tr slider-tr={{ $item->id }}>
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
                                                            {{ $item->name }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $item->slug }}
                                                    </td>

                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" slider-id={{ $item->id }}
                                                                onchange="statusChangeHandler(this)"
                                                                slider-status="{{ $item->status }}" type="checkbox"
                                                                name="status" {{ $item->status == 1 ? 'checked' : '' }}>

                                                        </div>

                                                    </td>

                                                    <td>
                                                        <a type="button" data-id="{{ $item->id }}"
                                                            onclick="restoreItem(this)"
                                                            class="btn btn-sm btn-primary   ">Restore</a>
                                                        <a type="button" data-id="{{ $item->id }}"
                                                            onclick="deleteItem(this)"
                                                            class="btn btn-sm btn-danger">Delete</a>
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
                    $(".sortable").find("[slider-tr").map((key, event) => {
                        // console.log(key, event)
                        let sliderID = event.getAttribute("slider-tr")
                        let index = key
                        if (sliderID) {
                            data = {
                                id: sliderID,
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
                        url: "{{ route('slider.orderArchiveChangeHandler') }}",
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
            const statusHandler = e.getAttribute("slider-status")
            const sliderIdHandler = e.getAttribute("slider-id")
            // console.log(statusHandler);
            const status = statusHandler == 1 ? 0 : 1;
            e.setAttribute("isStatus", status)
            data = {
                _token: "{{ csrf_token() }}",
                id: sliderIdHandler,
                status: status
            }
            $.ajax({
                type: "POST",
                url: "{{ route('slider.statusArchiveChangeHandler') }}",
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
                title: 'Are you sure you want to delete it permanently?',
                showCancelButton: "Cancel",
                cancelButtonText: "Cancel",
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(e).data("id");
                    // console.log(id);
                    const token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "archive/" + id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.status == 201) {
                                Swal.fire('Deletion successful', '', 'success')
                                e.closest("tr").remove();
                            } else {
                                // console.log("hata");
                                Swal.fire('An error occurred during the operation !', '', 'danger')

                            }
                        }
                    });
                }
            })

        }

        function restoreItem(e) {

            Swal.fire({
                title: 'Are you sure you want to restore ?',
                showCancelButton: "Cancel",
                cancelButtonText: "Cancel",
                confirmButtonText: 'Restore',
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(e).data("id");
                    const token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "archive/restore/" + id,
                        type: 'POST',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.status == 201) {
                                Swal.fire('Restoration successful !', '', 'success')
                                e.closest("tr").remove();
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
