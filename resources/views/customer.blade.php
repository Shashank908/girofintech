@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    Hi there, awesome Customer
                    <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href='/payment'><button type="button" class="btn btn-primary">
                                    {{ __('Checkout') }}
                                </button></a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection