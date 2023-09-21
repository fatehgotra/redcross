@extends('layouts.app')
@section('title', 'Home | Fiji Red Cross Society')
@section('content')
@include('admin.includes.flash-message')
<section>
    <div class="container py-2 text-center">
    <div class="card">
         <div class="card body">
        @if( !is_null($account) )
        <h3>Payment Details</h3>
        <h4>Please pay membership fees to the following payment details</h4>
        <table class="table table-bordered" style="height:48vh">
            <tr>
                <th>Bank Branch</th>
                <td>{{ $account->branch }}</td>
            </tr>
            <tr>
                <th>Bank Name</th>
                <td>{{ $account->bank }}</td>
            </tr>
            <tr>
                <th>Account Number</th>
                <td>{{ $account->account }}</td>
            </tr>
            <tr>
                <th>Account Name</th>
                <td>{{ $account->account_name }}</td>
            </tr>
        </table>
        @else
          <div class="text-center" style="height:61vh">
           <h2 style="padding-top:15%"> Please visit at branch and pay for your membership </h2>
           <h3 style="margin:3%"> Visiting branch : {{ $user->branch }}</h3>
           <h3 style="margin:3%"> Your User ID is : {{ $user->id }}</h3>
          </div>
        @endif
      

         </div>
        </div>
    </div>
</section>
@endsection