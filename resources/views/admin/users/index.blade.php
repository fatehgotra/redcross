@extends('layouts.admin')
@section('title', 'Volunteers')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            @if(request()->get('status'))
                            <li class="breadcrumb-item active">{{ ucfirst(request()->get('status')) }} Volunteers</li>
                            @endif
        
                            @if(request()->get('active'))
                            <li class="breadcrumb-item active">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Volunteers</li>
                            @endif
                        </ol>
                    </div>
                    @if(request()->get('status'))
                    <h4 class="page-title">{{ ucfirst(request()->get('status')) }} Volunteers</h4>
                    @endif

                    @if(request()->get('active'))
                        <h4 class="page-title">{{ request()->get('active') == 'yes' ? 'Active': 'Inactive' }} Volunteers</h4>
                    @endif
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Volunteer Name</th>
                                            <th>Email Address</th>
                                            <th>Contact Number</th>                                            
                                            <th>Date Added</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                                </td>
                                                @if($user->status == 'approve')
                                                <td><span
                                                    class="badge bg-success">Approved ({{ $user->approved_by }})</span></td>
                                                @elseif($user->status == 'decline')
                                                <td><span
                                                    class="badge bg-danger">Declined ({{ $user->approved_by }})</span></td>
                                                @else
                                                <td><span
                                                    class="badge bg-info">Pending</span></td>
                                                @endif
                                                <td>
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">                                                        
                                                        <a href="{{ route('admin.volunteer-detail.lodge-information.form', $user->id) }}"
                                                            class="dropdown-item"><i class="mdi mdi-eye"></i>
                                                            Show Details</a>  
                                                            <a href="{{ route('admin.volunteer.approval-history', $user->id) }}"
                                                                class="dropdown-item"><i class="mdi mdi-information-variant"></i>
                                                                Approval History</a>        
                                                            <a href="javascript:void(0);" class="dropdown-item change-password"
                                                        data-bs-toggle="modal" data-bs-target="#modal-password"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->firstname }} {{ $user->lastname }}"><i
                                                            class="mdi mdi-key"></i> Reset Password</a>                                                  
                                                    
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $user->id }})"
                                                            class="dropdown-item"><i class="mdi mdi-trash-can"></i>
                                                            Delete
                                                            Volunteer</a>
                                                        <form id='delete-form{{ $user->id }}'
                                                            action='{{ route('admin.volunteers.destroy', $user->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-passwordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <p class="modal-title text-center" id="primary-header-modalLabel"><strong>Want to Change Password of </strong><span id="volunteer_name">{{ old('volunteer_name') }}</span></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="changePasswordForm" action="{{ route('admin.volunteer.reset-password') }}">
                        @csrf
                        <input type="hidden" value="{{ old('volunteer_name') }}" name="volunteer_name" id="volunteer_name_input">
                        <input type="hidden" value="{{ old('id') }}" name="id" id="id">
                        <div class="form-group mb-2 {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">New password *</label>
                            <input type="password" id="password" name="password" placeholder="Enter new password" class="form-control">
                            @error('password')
                                <code id="name-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group mb-2 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation">Confirm password *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Re-enter new password">
                        </div>
                    </form>
                </div>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="changePasswordForm" class="btn btn-sm btn-success">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datatables js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


    <!-- Datatable Init js -->
    <script>
        $(function() {
            $("#basic-datatable").DataTable({
                "paging": true,
                "pageLength": 20,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [
                    [0, 'desc']
                ]
            });
        });
    </script>


    <script type="text/javascript">
        function confirmDelete(no) {
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
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>

<script>
    $(".change-password").click(function () {
            var id = $(this).data('id');  
            var name = $(this).data('name');         
            $('#id').val(id);
            $('#volunteer_name').text(name);
            $('#volunteer_name_input').val(name);
        });
</script>
@error('password')
<script>
    $(document).ready(function () {
        $('#modal-password').modal('show');
    });
</script>
@enderror
@endpush
