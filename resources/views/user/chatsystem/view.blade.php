@extends('layouts.app')
@section('title', 'Chat System')
@section('content')
<section class="breadcrumbs text-center">
    <div class="container">
        <h1>{{__('locale.sidebar.chat_support_text') }}</h1>
        <ul>
        <li><a href="/">{{__('locale.breadcrumb.breadcrumb_home_text') }}</a></li>
            <li>|</li>
            <li class="active"><a href="#">{{__('locale.sidebar.chat_support_text') }}</a></li>
        </ul>
    </div>
</section>
<section class="password-update">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
                @include('guest.includes.flash-message')
        </div>
       </div>
        <div class="row">
            <div class="col-sm-3">
                @include('user.includes.sidebar')
            </div>
            <div class="col-sm-9">               
            <div class="row">
            <div class="col-12">
            <div class="row">
            <div class="col-sm-9">
               <h4 class="header-title mb-3">Replies</h4>
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
                            <input type="hidden" name="message_id" value="{{$message_info->id}}" >
                            <input type="hidden" name="user_id" value="{{ $message_info->id }}" >
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

            <div class="col-sm-3 bg-danger text-white" style="background-color:#00a4f39e!important;border-radius:3%;">
               <div class="media-body mb-3 mt-3">
                  <h5 class="mt-0 mb-1">Enquiry Type</h5>
                  <p class="text-dark">{{ str_replace('_',' ',$support->enquiry_type) }}</p>
               </div>
               <div class="media-body mb-3">
                  <h5 class="mt-0 mb-1">Description</h5>
                  <span class="text-dark">
                     <p>{!! $support->description !!}</p>
                  </span>
               </div>
               <div class="media-body mb-3">
                  <h5 class="mt-0 mb-1">email</h5>
                  <p class="text-dark">{{ $support->email }}</p>
               </div>
               
                
                @if(!empty($support->files))

                <div class="media-body mb-3">
                  <h5 class="mt-0 mb-1">Attachment</h5>
                  
                @foreach( $support->files as $file )

                  <div class="card mb-2 shadow-none border">
                     <div class="p-1">
                        <div class="row align-items-center">
                           <div class="col-auto">
                              <div class="avatar-sm">
                                 <span class="avatar-title rounded">
                                 File
                                 </span>
                              </div>
                           </div>
                           <div class="col pl-0">
                              <a href="javascript:void(0);" class="text-muted font-weight-bold">{{ $file->filename }}</a>
                           </div>
                           <div class="col-auto">
                              <!-- Button -->
                              <a href="{{ asset('/assets/images').'/'.$file->filename }}" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-link text-muted btn-lg p-0" data-original-title="Download" download="">
                              <i class="uil uil-cloud-download"></i>
                              </a>
                              <a href="/ticket/delete-attachment/{{ $file->id }}" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-link text-danger btn-lg p-0" data-original-title="Delete">
                              <i class="uil uil-multiply"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>

                @endforeach
                </div>
                @endif
            </div>
         </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datatables js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
    <!-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> -->
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
                    [0, 'asc']
                ]
            });
        });

        function changeStatus() {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update Ticket'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('changeStatus').submit();
                }
            })
        };

    </script>

<!-- <script>

Pusher.logToConsole = true;

var pusher = new Pusher('29e8f22ab983aa676851', {
  cluster: 'ap2'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  alert(JSON.stringify(data));
});
</script> -->

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
                url: "{{ url('userstoreConversations') }}",
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
            success: function(data){
                $('.conversation-list').html('');
                $.each(data, function(i, v) {
                            $('.conversation-list').append(`
                                <li ${(v.user_id == 1) ? 'class="clearfix"' : 'class="clearfix odd"'} style="overflow: visible">
                                    <div class="chat-avatar">
                                    <img src="{{ asset('/assets/images/avatar.jpg') }}" alt="Female">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                        <b>${v.user_id == 1 ? 'Admin' : v.user.first_name }</b> <br>
                                            <p>
                                                ${v.message}
                                            </p>
                                            <i>${ new Date(v.created_at).toLocaleString("en-GB") }</i>
                                        </div>
                                </div>
                            </li>
                        `);                 
                })

                  var scrollDown    = $('#ko');
                  if(scrollDown[0] != undefined) {
                     var height = scrollDown[0].scrollHeight;
                     scrollDown.scrollTop(height);
                  } else if(data.length == 1) {
                     //window.location.reload(0);
                  }
                
            }
        });
            
        }, 1000);

        // $('#ko').on('scroll', function() { 
        //     clearInterval(timer);
        // });
      
        
    })
</script>
@endpush
