@extends('admin.layouts.main')

@section('title', 'Permission')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Permission
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="createNewPermission">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add new permission
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permissionTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPermission" name="formPermission" class="form-horizontal">
                        <input type="hidden" name="permission_id" id="permission_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" maxlength="50" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" type="submit" id="saveBtn" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var table = $('#permissionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.permission.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#createNewPermission").click(function(e) {
                e.preventDefault();
                $('#modalTitle').html('Add new permission');
                $('#permission_id').val('');
                $('#permissionModal').modal('show');
                $('#formPermission')[0].reset();
            });

            $('body').on('click', '.edit', function(e) {
                e.preventDefault();
                var permission_id = $(this).data('id');
                $('#modalTitle').html('Update Role')
                $('#formPermission')[0].reset();
                if (permission_id) {
                    $('#permission_id').val(permission_id);
                    let url = '/admin/permission/edit/' + permission_id;
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(result) {
                            $('#permissionModal').modal('show');
                            $('#name').val(result.data.name);
                        },
                        error: function(result) {

                        }
                    })
                }
            })

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var permission_id = $('#permission_id').val();

                if (permission_id == '') {
                    var type = "POST";
                    var url = "{{ route('admin.permission.store') }}";
                } else {
                    var type = "PUT";
                    var url = '/admin/permission/update/' + permission_id;
                }
                $.ajax({
                    type: type,
                    url: url,
                    data: $('#formPermission').serialize(),
                    dataType: "JSON",
                    success: function(result) {
                        $('#permissionModal').modal('hide');
                        $('#formPermission')[0].reset();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        table.draw();
                    },
                    error: function(result) {
                        console.log(result)
                    }
                })
            })

            $('body').on('click', '.delete', function(e) {
                e.preventDefault();
                var permission_id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = '/admin/permission/destroy/' + permission_id;
                        data:
                            $.ajax({
                                type: "DELETE",
                                url: url,
                                success: function(result) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: result.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    table.draw();
                                },
                                error: function(result) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!<br> Error:' +
                                            result,
                                    })
                                }
                            })
                    }
                })
            })

        })
    </script>
@endsection
