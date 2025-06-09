@extends('layouts.LandingPageLayout.landing')
@section('title')
    Art-Express - Terms and Conditions
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="bg-success bg-gradient text-white py-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold">Art-Express Terms & Conditions</h1>
                    <p class="lead">Last updated: <span id="current-date"></span></p>
                    <p class="mt-3">Welcome to Art-Express! Please read these terms carefully before using our platform.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Introduction -->
                <section class="my-4">
                    <p>These Terms and Conditions govern your use of the Art-Express platform , which provides a marketplace
                        for artists to showcase and sell their artwork, participate in auctions, and connect with art
                        enthusiasts.</p>
                    <p>By accessing or using our Platform, you agree to be bound by these Terms. If you disagree with any
                        part, you may not access the Platform.</p>
                </section>

                <!-- Account Registration -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">1. Account Registration</h2>
                    <p>To fully utilize Art-Express, users must create an account with accurate and complete information.
                    </p>

                    <div class="bg-light border-start border-4 border-success p-4 my-4">
                        <h5 class="text-success"><i class="bi bi-exclamation-circle-fill me-2"></i>Important Requirements:
                        </h5>
                        <ul>
                            <li><strong>Artists</strong> must complete their profile before adding any products to the
                                Store/Gallery</li>
                            <li><strong>Users</strong> must complete their profile with all required details before
                                registering for any auction</li>
                            <li>All users are responsible for maintaining the confidentiality of their account credentials
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Artwork Listings -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">2. Artwork Listings & Product Management</h2>
                    <p>Art-Express provides tools for artists to manage their artwork listings and for administrators to
                        oversee platform operations.</p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Artist Responsibilities</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Artists have full control over their artwork listings
                                        </li>
                                        <li class="list-group-item">Must provide accurate descriptions and representations
                                            of artworks</li>
                                        <li class="list-group-item">Responsible for maintaining inventory accuracy</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Admin Responsibilities</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Admins can manage products but cannot create artworks
                                        </li>
                                        <li class="list-group-item">Monitor platform for policy compliance</li>
                                        <li class="list-group-item">Handle dispute resolution between users</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Order Placement & Payments -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">3. Orders & Payments</h2>
                    <p>Art-Express supports multiple payment methods with specific conditions for order processing and
                        cancellations.</p>

                    <div class="bg-light border-start border-4 border-success p-4 my-4">
                        <h5 class="text-success"><i class="bi bi-credit-card me-2"></i>Payment Methods:</h5>
                        <ul>
                            <li>Credit/Debit Card payments processed via Stripe</li>
                            <li>Cash on Delivery (COD) option available</li>
                        </ul>
                    </div>

                    <h4 class="mt-4">Order Cancellation Policy</h4>
                    <div class="alert alert-warning">
                        <h5 class="alert-heading">Cancellation Conditions</h5>
                        <ul class="mb-0">
                            <li>Only administrators can cancel orders</li>
                            <li>Artists <strong>cannot</strong> cancel orders once placed for his artworks</li>
                            <li>Custom requests <strong>cannot</strong> be cancelled</li>
                            <li>Standard orders can only be cancelled while in "Pending" status</li>
                        </ul>
                    </div>

                    <div class="alert alert-danger mt-3">
                        <h5 class="alert-heading">Refund Policy for Card Payments</h5>
                        <p>For card payments, order cancellations will incur:</p>
                        <ul class="mb-0">
                            <li>A <span class="badge bg-warning text-dark">10% penalty</span> of the order value</li>
                            <li>A fixed <span class="badge bg-warning text-dark">100 Rs refund charge</span></li>
                        </ul>
                    </div>
                </section>

                <!-- Delivery Conditions -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">4. Delivery & Fulfillment</h2>

                    <div class="card border-success mb-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Delivery Scenarios</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>If User Doesn't Take Delivery:</h6>
                                    <ul>
                                        <li>The artwork becomes property of Art-Express</li>
                                        <li>The artist will still be paid for the sale</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>If Artist Doesn't Provide Artwork:</h6>
                                    <ul>
                                        <li>The sale will be cancelled</li>
                                        <li>Artist must pay fuel expenses incurred by the rider</li>
                                        <li>Artist may face additional platform restrictions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Auction System -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">5. Auction System</h2>
                    <p>Art-Express provides an auction platform for exclusive artworks with specific participation
                        requirements.</p>

                    <div class="alert alert-info">
                        <h5 class="alert-heading">Auction Participation Rules</h5>
                        <ul class="mb-0">
                            <li>Users must have complete profile information to register for auctions</li>
                            <li>Winning bids constitute a binding agreement to purchase</li>
                            <li>Winners receive checkout confirmation and can pay for the art piece they won</li>
                            <li>Won auction items will be treated as custom orders</li>
                            <li>Non-payment may result in account suspension</li>
                        </ul>
                    </div>
                </section>

                <!-- Messenger System -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">6. Messenger & Custom Requests</h2>
                    <p>Our platform includes a messaging system to facilitate communication between artists and buyers.</p>

                    <div class="bg-light border-start border-4 border-success p-4 my-4">
                        <h5 class="text-success"><i class="bi bi-chat-dots me-2"></i>Important Notes:</h5>
                        <ul>
                            <li>Messenger is for art-related communications only</li>
                            <li>Custom requests made through messenger cannot be cancelled once accepted by artist</li>
                            <li>Art-Express is not responsible for agreements made outside the platform</li>
                        </ul>
                    </div>
                </section>

                <!-- General Provisions -->
                <section class="my-4">
                    <h2 class="border-start border-5 border-success ps-3 my-4">7. General Provisions</h2>
                    <ul>
                        <li>Art-Express reserves the right to modify these Terms at any time</li>
                        <li>Continued use of the platform constitutes acceptance of modified Terms</li>
                        <li>For disputes and reports mail at <a href="mailto:info@art-express.com">info@art-express.com</a> </li>
                        <li>Disputes will be governed by the laws of Pakistan</li>
                    </ul>
                </section>

                <!-- Acceptance -->
                <section class="mt-5 text-center">
                    <div class="card border-success">
                        <div class="card-body">
                            <h4 class="card-title">Acceptance of Terms</h4>
                            <p class="card-text">By using Art-Express, you acknowledge that you have read, understood, and
                                agree to be bound by these Terms and Conditions.</p>
                            <a href="{{ route('welcome') }}" class="btn btn-success">Back to Home</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Set current date and year
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', options);
        });
    </script>
@endpush
