@extends('layouts.user')
@section('title', 'Chat Tickets')
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
                <h4 class="page-title">Chat Tickets</h4>
            </div>
        </div>
    </div>
    @include('user.includes.flash-message')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{__('locale.ticket_list.emails_text') }}</th>
                                        <th>{{__('locale.ticket_list.enquiry_type_text') }} </th>
                                        <th>{{__('locale.ticket_list.description_text') }}</th>
                                        <th>{{__('locale.orders.action_text') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($tickets))
                                    @foreach ($tickets as $p)
                                    <tr>
                                        <td>{{ $p->email }}</td>
                                        <td>{{ str_replace('_',' ',$p->enquiry_type) }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td>
                                            @if($p->status == 1)
                                            <a href="/user/chat-view-ticket/{{ $p->id }}/{{ $p->user_id }}" class="mdi mdi-eye-circle-outline" style="font-size:27px;cursor:pointer"></span>
                                                @else
                                                <a href="javascript:void(0)" disaabled="true" class="mdi mdi-eye-circle-outline" style="font-size:27px;cursor:pointer"></span>
                                                    @endif
                                                    <a class="mdi mdi-delete-circle-outline danger" onclick="confirmDelete({{ $p->id }})" style="font-size:27px;cursor:pointer"></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{__('locale.ticket_list.no_ticket_text') }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection