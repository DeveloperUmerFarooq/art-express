@extends('layouts.LandingPageLayout.landing')

@section('page')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-success text-white py-4">
                    <div class="text-center">
                        <i class="fas fa-envelope fa-3x mb-3"></i>
                        <h2 class="mb-0">{{ __('Verify Your Email Address') }}</h2>
                    </div>
                </div>

                <div class="card-body p-5 text-center">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <i class="fas fa-envelope-open-text fa-4x text-success mb-4"></i>
                        <p class="lead">{{ __('Almost there!') }}</p>
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p class="text-muted">{{ __('Press the following button to recieve a verification email!') }}</p>
                    </div>

                    <hr class="my-4">
                    @if (session('resent'))
                    <p class="text-muted mb-4">{{ __('Didn\'t receive the email?') }}</p>
                    @endif
                    <form method="POST" action="{{ route('verification.resend') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-lg px-4">
                            <i class="fas fa-paper-plane me-2"></i>
                            @if (session('resent'))
                            {{ __('Resend Verification Email') }}
                            @else
                            {{ __('Send Verification Email') }}
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
