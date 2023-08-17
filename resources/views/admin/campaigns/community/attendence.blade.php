@extends('layouts.admin')
@section('title', 'Attendance')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Activites </a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </div>
                <h4 class="page-title">Attendance</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <p>Attendance Date : <strong>{{ \Carbon\Carbon::now()->format('M d Y') }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card border-warning border">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288" />
                                    </svg> <span class="card-title ms-1 h5">{{ $community->title }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            {!! $community->breif !!}
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <span class="badge badge-outline-success text-center">Starts On: <br>{{ \Carbon\Carbon::parse($community->starts_at)->format('M d, Y') }}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="badge badge-outline-danger text-center">Ends On: <br>{{ \Carbon\Carbon::parse($community->ends_at)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" id="submitAttendence" action="{{ route('admin.mark.community-attendance', $community->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="starts_at">
                    <input type="hidden" name="ends_at">
                    <input type="hidden" name="time_user">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Present</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Add Flag </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)

                                        @php
                                        $flag = \App\Models\Flag::where(['user_id'=>$user->id,'activity_id'=>$community->id])->get()->first();
                                        $start = \App\Models\CommunityAttendence::where(['date'=>\Carbon\Carbon::now()->format('d-m-Y') , 'email' => $user->email , 'activity_id' => $community->id ])->get()->first();
                                        $end  = \App\Models\CommunityAttendence::where(['date'=>\Carbon\Carbon::now()->format('d-m-Y') , 'email' => $user->email , 'activity_id' => $community->id ])->get()->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                            <td>

                                                <input type="checkbox" id="attendance_{{ $user->id }}" class="switch" name="attendance[]" value="{{ $user->id }}" data-switch="success" {{ in_array($user->email, $present_users) ? "checked" : "" }} />
                                                <label for="attendance_{{ $user->id }}" data-on-label="Yes" data-off-label="No"></label>
                                            </td>

                                            <td>{{ !is_null( $start ) ? $start->starts_at : 'NA' }} </td>
                                            <td>{{ !is_null( $end ) ? $end->ends_at : 'NA' }}</td>

                                            <td>
                                                @if( is_null($flag) )
                                                <a href="#" class="showreason" uid="{{ $user->id}}" style="font-size: 25px; color:black;"><i class="mdi mdi-flag-outline"></i></a>
                                                @else
                                                <a href="#" class="showFlag" res="{{ $flag->reason }}" style="font-size: 25px;"><i class="mdi mdi-flag"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <!-- <button type="submit" class="btn btn-sm btn-success" >Update Attendance</button> -->
                                <button type="button" class="btn btn-primary float-start" data-toggle="modal" data-target="#exampleModal"> Add user </button>
                                <button type="button" class="btn btn-info float-start ms-1" data-toggle="modal" data-target="#exampleModalExisting"> Add existing user </button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User to Activity</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.campagin-user') }}" method="POST" id="userform">
                        @csrf
                        <input type="hidden" name="activity" value="{{ $community->id }}">
                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> Firstname </label>
                            <input type="text" class="form-control" required name="firstname" id="firstname" placeholder="Enter firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-form-label"> Lastname </label>
                            <input type="text" class="form-control" required name="lastname" id="lastname" placeholder="Enter lastname">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label"> Email </label>
                            <input type="email" class="form-control" required name="email" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label"> password </label>
                            <input type="password" class="form-control" required name="password" id="password" placeholder="choose password">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label"> Phone </label>
                            <input type="number" class="form-control" required name="phone" id="phone" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> role </label>
                            <select class="form-control" required name="role">
                                <option value=""> --select role --</option>
                                <option value="volunteer">Volunteer</option>
                                <option value="member">Member</option>
                                <option value="both">both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> Branch </label>
                            <select id="branch" required class="form-select " name="branch">
                                <option value="">Nearest Branch</option>
                                <optgroup label="Central / Eastern">
                                    <option value="Rotuma">
                                        Rotuma
                                    </option>
                                    <option value="Levuka">
                                        Levuka
                                    </option>
                                    <option value="Suva">
                                        Suva
                                    </option>
                                </optgroup>
                                <optgroup label="Western">
                                    <option value="Sigatoka">
                                        Sigatoka
                                    </option>
                                    <option value="Nadi">
                                        Nadi
                                    </option>
                                    <option value="Lautoka">
                                        Lautoka
                                    </option>
                                    <option value="Ba">
                                        Ba
                                    </option>
                                    <option value="Tavua">
                                        Tavua
                                    </option>
                                    <option value="Rakiraki">
                                        Rakiraki
                                    </option>
                                    <option value="Nalawa">
                                        Nalawa
                                    </option>
                                </optgroup>
                                <optgroup label="Northern">
                                    <option value="Bua">
                                        Bua
                                    </option>
                                    <option value="Seaqaqa">
                                        Seaqaqa
                                    </option>
                                    <option value="Savusavu">
                                        Savusavu
                                    </option>
                                    <option value="Labasa">
                                        Labasa
                                    </option>
                                    <option value="Taveuni">
                                        Taveuni
                                    </option>
                                    <option value="Rabi">
                                        Rabi
                                    </option>
                                </optgroup>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="userform" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Time -->
    <div class="modal fade" id="exampleModalTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTime" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelTime">Add Hours</h5>
                    <button type="button" class="close btn btn-danger" onclick="{ $('#exampleModalTime').modal('hide'); }" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.campagin-user') }}" method="POST" id="userform">
                        @csrf
                        <input type="hidden" name="time_attend_user">

                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> Attendence Start Time </label>
                            <input type="time" name="st_at" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> Attendence End Time </label>
                            <input type="time" name="et_at" class="form-control">
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="{ $('#exampleModalTime').modal('hide'); }" data-dismiss="modal">Close</button>
                    <button type="submit" form="userform" class="btn btn-primary addTime">Update Attendence</button>
                </div>
            </div>
        </div>
    </div>


    <!----Add existing user------>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalExisting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User to Activity</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.campagin-user') }}" method="POST" id="userformExist">
                        @csrf
                        <input type="hidden" name="activity" value="{{ $community->id }}">
                        <input type="hidden" name="activity" value="{{ $community->id }}">
                        <div class="form-group">
                            <label for="firstname" class="col-form-label"> Select user </label>
                            <select class="form-control" required name="user_id">
                                <option value=""> --select user --</option>
                                @if( count($approvedUsers) > 0 )
                                @foreach( $approvedUsers as $user)

                                <option value="{{ $user->id }}">{{ $user->firstname." ".$user->lastname }}</option>

                                @endforeach
                                @endif

                            </select>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="userformExist" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-----Add Flag Modal--->

    <div class="modal fade" id="flagModal" tabindex="-1" role="dialog" aria-labelledby="FlagModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FlagModalLabel">Flag Reason</h5>
                    <button type="button" class="close btn btn-danger" onclick="{ $('#flagModal').modal('hide'); }" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.flag') }}" method="POST" id="flagForm">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $community->id }}">
                        <input type="hidden" name="user_id" value="" id="uid">
                        <div class="form-group">
                            <textarea class="form-control" required name="reason" placeholder="Enter Reason"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="{ $('#flagModal').modal('hide'); }" data-dismiss="modal">Close</button>
                    <button type="submit" form="flagForm" class="btn btn-primary">Add Flag</button>
                </div>
            </div>
        </div>
    </div>

    <!-----Show Flag Modal--->

    <div class="modal fade" id="flagModalShow" tabindex="-1" role="dialog" aria-labelledby="FlagModalShow" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FlagModalShow">Flag Reason</h5>
                    <button type="button" class="close btn btn-danger" onclick="{ $('#flagModalShow').modal('hide'); }" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mreason"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="{ $('#flagModalShow').modal('hide'); }" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
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
            "paging": false,
            "pageLength": 20,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
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
    jQuery(document).ready(function($) {

        $('.showreason').click(function(e) {
            e.preventDefault();
            let uid = $(this).attr('uid');
            $('#uid').val(uid);
            $('#flagModal').modal('toggle');
        });

        $('.showFlag').click(function(e) {
            e.preventDefault();
            let res = $(this).attr('res');
            $('.mreason').html(res);
            $('#flagModalShow').modal('toggle');
        });

        $('.switch').on('change', function(e) {

            if ($(this).is(':checked') == true) {
                $('input[name="time_attend_user"]').val($(this).val());
                $('#exampleModalTime').modal('show');

            } else {

                $('#submitAttendence').submit();
            }
        });

        $('.addTime').on('click', function(e) {

            let st = $('input[name="st_at"]').val();
            let et = $('input[name="et_at"]').val();
            let tu = $('input[name="time_attend_user"]').val();

            $('input[name="starts_at"]').val(tConvert(st));
            $('input[name="ends_at"]').val(tConvert(et));
            $('input[name="time_user"]').val(tu);

            $('#submitAttendence').submit();

        });


    });

    function tConvert(time) {
        // Check correct time format and split into components
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice(1); // Remove full string match value
            time[5] = +time[0] < 12 ? ':00 AM' : ':00 PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join(''); // return adjusted time or original string
    }
</script>
@endpush