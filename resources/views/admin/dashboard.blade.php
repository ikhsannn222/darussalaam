@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row g-3">

        <!-- Visitors -->
        <div class="col-6 col-md-3">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary text-white p-3 rounded-3 d-flex justify-content-center align-items-center">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted">Visitors</small>
                        <h5 class="mb-0 fw-bold">1,294</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscribers -->
        <div class="col-6 col-md-3">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-info text-white p-3 rounded-3 d-flex justify-content-center align-items-center">
                        <i class="fas fa-user-check fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted">Subscribers</small>
                        <h5 class="mb-0 fw-bold">1,303</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales -->
        <div class="col-6 col-md-3">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success text-white p-3 rounded-3 d-flex justify-content-center align-items-center">
                        <i class="fas fa-luggage-cart fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted">Sales</small>
                        <h5 class="mb-0 fw-bold">$1,345</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-6 col-md-3">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-purple text-white p-3 rounded-3 d-flex justify-content-center align-items-center" style="background-color: #6f42c1;">
                        <i class="far fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted">Orders</small>
                        <h5 class="mb-0 fw-bold">576</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
