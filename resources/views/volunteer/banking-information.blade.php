@php
    $banking_information = Session::get('banking-information');
@endphp
@extends('layouts.app')
@section('title', 'Volunteer Registration | Fiji Red Cross Society')
@section('content')
    <section>
        <div class="container pt-3">
            <h3 class="text-center">Volunteer Registration</h3>
        </div>
    </section>
    <section>
        <div class="container pt-3">
            <form action="{{ route('banking-information') }}" method="POST" id="bankingInformationForm">
                @csrf
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Personal Banking Information (Optional with Mobile Banking)</h4>
                        <p class="text-center text-muted">Step 12</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="bank" class="col-form-label">Bank <span
                                        class="text-danger">*</span></label>
                                <select id="bank"
                                    class="form-select @error('bank') is-invalid @enderror" name="bank">
                                    <option value="">Select Bank</option>                                   
                                    <option value="Bank of South Pacific (BSP)" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'Bank of South Pacific (BSP)' ? 'selected' : '' }}>Bank of South Pacific (BSP)
                                    </option>    
                                    <option value="Australia & New Zealand Banking Group (ANZ)" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'Australia & New Zealand Banking Group (ANZ)' ? 'selected' : '' }}>Australia & New Zealand Banking Group (ANZ)
                                    </option>                                  
                                    <option value="Home Finance Company Bank (HFC)" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'Home Finance Company Bank (HFC)' ? 'selected' : '' }}>Home Finance Company Bank (HFC)
                                    </option> 
                                    <option value="Bank of Baroda" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'Bank of Baroda' ? 'selected' : '' }}>Bank of Baroda
                                    </option> 
                                    <option value="Westpac" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'Westpac' ? 'selected' : '' }}>Westpac
                                    </option>                           
                                    <option value="BRED bank" {{ old('bank', isset($banking_information) ? $banking_information['bank'] : '') == 'BRED bank' ? 'selected' : '' }}>BRED bank
                                    </option>                                                                                                                            
                                </select>
                                @error('bank')
                                    <small id="bank-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                            <div class="col-lg-4">
                                <label for="account_number" class="col-form-label">Account Number <span
                                        class="text-danger">*</span></label>
                                        <input id="account_number" type="text"
                                        class="form-control @error('account_number') is-invalid @enderror"
                                        name="account_number"
                                        value="{{ old('account_number', isset($banking_information) ? $banking_information['account_number'] : '') }}"
                                        autocomplete="account_number"
                                        placeholder="Account Number">
                                @error('account_number')
                                    <small id="account_number-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                            <div class="col-lg-4">
                                <label for="name_bank_account" class="col-form-label">Name as used with Bank Account <span
                                        class="text-danger">*</span></label>
                                        <input id="name_bank_account" type="text"
                                        class="form-control @error('name_bank_account') is-invalid @enderror"
                                        name="name_bank_account"
                                        value="{{ old('name_bank_account', isset($banking_information) ? $banking_information['name_bank_account'] : '') }}"
                                        autocomplete="name_bank_account"
                                        placeholder="Name as used with Bank Account">
                                @error('name_bank_account')
                                    <small id="name_bank_account-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title text-center fw-bold">Mobile Banking Information (Optional with Personal Banking) </h4>
                        <p class="text-center text-muted">Step 13</p>
                    </div>
                    <div class="card-body">
                         <div class="form-group row">
                            <div class="col-lg-12">
                                <i>* Please ensure phone number is registered to you</i>
                            </div>
                             <div class="col-lg-6">
                                <label for="mobile_bank" class="col-form-label">Mobile Bank <span
                                        class="text-danger">*</span></label>
                                <select id="mobile_bank"
                                    class="form-select @error('mobile_bank') is-invalid @enderror" name="mobile_bank">
                                    <option value="">Select Mobile Bank</option>                                   
                                    <option value="Vodafone MPAISA" {{ old('mobile_bank', isset($banking_information) ? $banking_information['mobile_bank'] : '') == 'Vodafone MPAISA' ? 'selected' : '' }}>Vodafone MPAISA
                                    </option>    
                                    <option value="Digicel MyCash" {{ old('mobile_bank', isset($banking_information) ? $banking_information['mobile_bank'] : '') == 'Digicel MyCash' ? 'selected' : '' }}>Digicel MyCash
                                    </option>                                                                                                                                                                                               
                                </select>
                                @error('mobile_bank')
                                    <small id="mobile_bank-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                            <div class="col-lg-6">
                                <label for="mobile_bank_number" class="col-form-label">Mobile Number registered with Mobile banking Service <span
                                        class="text-danger">*</span></label>
                                        <input id="mobile_bank_number" type="text"
                                        class="form-control @error('mobile_bank_number') is-invalid @enderror"
                                        name="mobile_bank_number"
                                        value="{{ old('mobile_bank_number', isset($banking_information) ? $banking_information['mobile_bank_number'] : '') }}"
                                        autocomplete="mobile_bank_number"
                                        placeholder="Mobile Number registered with Mobile banking Service">
                                @error('mobile_bank_number')
                                    <small id="mobile_bank_number-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                            <div class="col-lg-12">
                                <label for="name_mobile_bank_account" class="col-form-label">Name as registered with Mobile banking Service <span
                                        class="text-danger">*</span></label>
                                        <input id="name_mobile_bank_account" type="text"
                                        class="form-control @error('name_mobile_bank_account') is-invalid @enderror"
                                        name="name_mobile_bank_account"
                                        value="{{ old('name_mobile_bank_account', isset($banking_information) ? $banking_information['name_mobile_bank_account'] : '') }}"
                                        autocomplete="name_mobile_bank_account"
                                        placeholder="Name as registered with Mobile banking Service">
                                @error('name_mobile_bank_account')
                                    <small id="name_mobile_bank_account-error" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('service-interest.form') }}"
                            class="btn btn-sm btn-warning float-start">Previous
                            Step</a>
                        <button type="submit" form="bankingInformationForm"
                            class="btn btn-sm btn-success float-end">Next
                            Step</button>
                    </div>
            </form>
        </div>
    </section>
    <section>
        <div class="container pt-1 pb-3">
            <ul>
                <li>
                    Please note that all the information bothered here is treated as "Confidential". Information will only
                    be
                    used for the management of members and volunteers and access Is limited to <strong> authorised persons
                        only.</strong>
                </li>
                <li>Volunteers will have to re-register if inactive for more than 2 years</li>
            </ul>
        </div>
    </section>
@endsection
