@extends('layouts.admin')
@section('title', 'Chat Tickets')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Learning</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
                </div>
                <h4 class="page-title">Chat</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="card-body">
                    <div class="container card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">Conversation</h4>
                            </div>
                            <div class="col-md-6">
                            <a href="{{ route('admin.ticket-list') }}" class="btn btn-sm btn-dark float-end">Back</a>
                            </div>
                        </div>
                

                        <div class="row">
                            <div class="col-sm-9">
                                <div class="chat-conversation">
                                    <div data-simplebar="init" style="height: 600px;">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div chat-content id="ko" style="overflow-y: scroll; width: auto; height: 580px;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <ul class="conversation-list">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar" style="height: 348px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                        </div>
                                    </div>
                                    @csrf
                                    <div class="row">
                                        <form class="form-group" style="margin-top: 20px" action="">
                                            <input type="hidden" name="message_id" value="{{$message_info->id}}">
                                            <input type="hidden" name="user_id" value="{{ $message_info->id }}">
                                            <div class="input-group">
                                                <div id="typing"></div>
                                                <input type="text" name="message" id="message_typing" autocomplete="off" chat-box class="form-control" placeholder="Type...">
                                                <div class="input-group-prepend">
                                                    <button type="button" id="submitMessage" class="btn chat-send btn-block waves-effect waves-light" style="background-color:#00a4f39e!important;color:black"><i class="mdi mdi-send"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 card card-body text-white1" style1="background-color:#00a4f39e!important;border-radius:1%;">

                                <div class="media-body mb-3 mt-3">
                                    <div class="media-body mb-3">
                                        <button onclick="markClose({{ $support->id }})" class="btn btn-outline-success">Mark Close</button>
                                    </div>

                                    <div class="media-body mb-3">
                                        <h5 class="mt-0 mb-1">#Chat ID</h5>
                                        <p class="text-dark">{{ $support->id }}</p>
                                    </div>

                                    <h5 class="mt-0 mb-1">Enquiry Type</h5>
                                    <p class="text-dark">{{ $support->enquiry_type }}</p>
                                </div>
                                <div class="media-body mb-3">
                                    <h5 class="mt-0 mb-1">Description</h5>
                                    <span class="text-dark">
                                        <p>{!! $support->description !!}</p>
                                    </span>
                                </div>

                                <form action="{{ route('admin.mark-ticket-close',$support->id ) }}" id="close-form{{$support->id}}" method="post" >
                                  @csrf
                                </form>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        .chat-conversation {
            background-color: aliceblue;
            font-family: sans-serif;
        }

        .conversation-list {
            list-style: none;
            padding: 42px 15px;
        }
    </style>
    @endsection

    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datatables js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjzrBuBZeqiQaUzI7EJxZwtQEYFfkBnhs&li&callback=initAutocomplete&libraries=places&v=weekly" async defer></script>

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
        function markClose(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, close it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('close-form' + no).submit();
                }
            })
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#submitMessage').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "{{ route('admin.storeConversations') }}",
                    method: 'post',
                    data: {
                        message_id: $('[name="message_id"]').val(),
                        message: $('[name="message"]').val(),
                        user: $('[name="user_id"]').val()
                    },
                    success: function(result) {
                        $('[name="message"]').val('');
                    }
                })
            });

            var timer = setInterval(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var value = $('[name="message_id"]').val();
                var user = $('[name="user_id"]').val();
                $.ajax({
                    url: "{{ url('getConversations') }}",
                    method: "get",
                    data: {
                        id: value
                    },
                    success: function(data) {
                        $('.conversation-list').html('');
                        $.each(data, function(i, v) {
                            $('.conversation-list').append(`
                                <li ${(v.flex == 1) ? 'class="clearfix"' : 'class="clearfix odd"'} style="overflow: visible">
                                    <div class="chat-avatar">
                                    <img src="{{ asset('/assets/images/speech.png') }}" alt="Female">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p>
                                                ${v.message}
                                            </p>
                                            <br>
                                            <small>${ new Date(v.created_at).toLocaleString("en-GB") }</small>
                                        </div>
                                </div>
                            </li>
                        `);
                        })

                        var scrollDown = $('#ko');
                        if (scrollDown[0] != undefined) {
                            var height = scrollDown[0].scrollHeight;
                            //scrollDown.scrollTop(height);
                        } else if (data.length == 1) {
                            //window.location.reload(0);
                        }

                    }
                });

            }, 1000);

            // $('#ko').on('scroll', function() { 
            //     clearInterval(timer);
            // });

            var input = document.getElementById("message_typing");
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {

                    event.preventDefault();

                    document.getElementById("submitMessage").click();
                }
            });


        })
    </script>


    @endpush