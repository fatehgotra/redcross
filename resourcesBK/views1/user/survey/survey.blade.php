@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-5 justify-content-center">
        <div class="col-md-12">
            <div class="card">
            
            @if( isset($user) && isset( $survey ) )

                @if( session('success') )

                <div class="alert alert-success mb-3"> {{ session('success') }}</div>
                @endif

                @if( session('error') )

                <div class="alert alert-danger mb-3"> {{ session('error') }}</div>
                @endif
                <form action="{{ route('submit-survey') }}" method="POST">
                    @csrf
                    <input type="hidden" name="uid" value="{{ $user->id }}">
                    <input type="hidden" name="id" value="{{ $survey->id }}">
                    <div class="card-body">
                        @include('survey::standard', ['survey' => $survey])
                    </div>
                </form>
            @else
            <div class="alert alert-danger"> Something went wrong !!</div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection