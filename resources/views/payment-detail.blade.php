@extends('layouts.app')
@section('title', 'Home | Fiji Red Cross Society')
@section('content')
@include('admin.includes.flash-message')    
    <section>
        <div class="container py-2 text-center">
            <h3>Payment Details</h3>
            <h4>Please pay membership fees to the following payment details</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Bank Name</th>
                    <td>Westpac Banking Corporation</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>4988777589564</td>
                </tr>
                <tr>
                    <th>Bank Branch</th>
                    <td>SUVA</td>
                </tr>
                <tr>
                    <th>Account Holder</th>
                    <td>Ritesh</td>
                </tr>
                <tr>
                    <th>Branch Code</th>
                    <td>WPACFJX</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>PUNB0152400</td>
                </tr>
            </table>
        </div>
    </section>
@endsection