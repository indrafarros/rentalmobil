@extends('admin.layouts.main')

@section('title', 'User')

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
                        Users
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="createNewUser">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add new user
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
                    <table id="userTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
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
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUser" name="formUser" class="form-horizontal">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group mb-3">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter Username" maxlength="50" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" maxlength="50" required>
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
        })
        $(document).ready(function() {

            var table = $('#userTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            })

            $('#createNewUser').click(function(e) {
                e.preventDefault();
                $('#modalTitle').html('Create a new user')
                $('#userModal').modal('show');
            })

            $('#saveBtn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    data: $('#formUser').serialize(),
                    url: "{{ route('admin.user.store') }}",
                    success: function(result) {
                        $('#userModal').modal('hide');
                        $('#formUser')[0].reset();
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

                    }
                })
            })

            $('body').on('click', '.edit', function(e) {
                e.preventDefault();
                var user_id = $(this).data('id');
                $('#modalTitle').html('Update User')
                if (user_id) {
                    let url = '/admin/user/edit/' + user_id;
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(result) {
                            if (result.status == true) {
                                $('#userModal').modal('show');
                                $('#user_id').val(result.data.id)
                                $('#name').val(result.data.name)
                            }
                        },
                        error: function(result) {

                        }
                    })
                }
            })

            $('body').on('click', '.delete', function(e) {
                e.preventDefault();
                var user_id = $(this).data('id');
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
                        let url = '/admin/user/destroy/' + user_id;
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
        });
    </script>
@endsection
