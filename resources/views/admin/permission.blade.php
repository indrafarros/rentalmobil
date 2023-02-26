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
                        Combo layout
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                New view
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
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
                    <table class="table table-vcenter table-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paweł Kuna</td>
                                <td class="text-muted">
                                    UI Designer, Training
                                </td>
                                <td class="text-muted"><a href="#" class="text-reset">paweluna@howstuffworks.com</a>
                                </td>
                                <td class="text-muted">
                                    User
                                </td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, commodi cupiditate
                                    debitis deserunt
                                    expedita hic incidunt iste modi molestiae nesciunt non nostrum perferendis perspiciatis
                                    placeat praesentium
                                    quaerat quo repellendus, voluptates.
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jeffie Lewzey</td>
                                <td class="text-muted">
                                    Chemical Engineer, Support
                                </td>
                                <td class="text-muted"><a href="#" class="text-reset">jlewzey1@seesaa.net</a></td>
                                <td class="text-muted">
                                    Admin
                                </td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, commodi cupiditate
                                    debitis deserunt
                                    expedita hic incidunt iste modi molestiae nesciunt non nostrum perferendis perspiciatis
                                    placeat praesentium
                                    quaerat quo repellendus, voluptates.
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Mallory Hulme</td>
                                <td class="text-muted">
                                    Geologist IV, Support
                                </td>
                                <td class="text-muted"><a href="#" class="text-reset">mhulme2@domainmarket.com</a>
                                </td>
                                <td class="text-muted">
                                    User
                                </td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, commodi cupiditate
                                    debitis deserunt
                                    expedita hic incidunt iste modi molestiae nesciunt non nostrum perferendis perspiciatis
                                    placeat praesentium
                                    quaerat quo repellendus, voluptates.
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Dunn Slane</td>
                                <td class="text-muted">
                                    Research Nurse, Sales
                                </td>
                                <td class="text-muted"><a href="#" class="text-reset">dslane3@epa.gov</a></td>
                                <td class="text-muted">
                                    Owner
                                </td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, commodi cupiditate
                                    debitis deserunt
                                    expedita hic incidunt iste modi molestiae nesciunt non nostrum perferendis perspiciatis
                                    placeat praesentium
                                    quaerat quo repellendus, voluptates.
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Emmy Levet</td>
                                <td class="text-muted">
                                    VP Product Management, Accounting
                                </td>
                                <td class="text-muted"><a href="#" class="text-reset">elevet4@senate.gov</a></td>
                                <td class="text-muted">
                                    Admin
                                </td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, commodi cupiditate
                                    debitis deserunt
                                    expedita hic incidunt iste modi molestiae nesciunt non nostrum perferendis perspiciatis
                                    placeat praesentium
                                    quaerat quo repellendus, voluptates.
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
