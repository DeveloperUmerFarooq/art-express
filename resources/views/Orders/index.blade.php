@extends('layouts.' . $role . 'Layout.layout')
@section('title')
    {{ request()->is('artist/sales') ? 'Sales' : 'Orders' }} | Art-Express
@endsection
@section('page')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">
                <i class="fas fa-box-open me-2"></i>
                {{ request()->is('artist/sales') ? 'Sales' : 'Orders' }}
            </h2>

            @if (request()->is('artist/sales'))
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#customRequestModal">
                    <i class="fas fa-plus me-1"></i> Add Custom Request
                </button>
            @endif
        </div>

        @if ($orders->isEmpty())
            <div class="card shadow border-0 rounded-lg my-5">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-clipboard-list fa-4x text-secondary mb-3"></i>
                        <h3 class="h4 text-gray-900 mb-2">No Orders Found</h3>
                        <p class="text-muted">No orders have been placed yet.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row g-4 py-3">
                @foreach ($orders as $order)
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-auto border-0">
                            <div class="card-header bg-success text-white rounded-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 d-flex align-items-center">

                                            Order #{{ $order->id }}
                                        </h5>
                                        <div class="text-white-50 small mt-1">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('F j, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="h5 mb-0 font-weight-bold">
                                            {{ number_format($order->items->sum('total_price'), 0) }} Rs</div>
                                    </div>
                                </div>
                            </div>

                            <div id="collapse{{ $order->id }}" class="collapse show"
                                aria-labelledby="heading{{ $order->id }}">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap mb-3">
                                        <span
                                            class="badge badge-{{ $order->payment_status == 'Payed' ? 'success' : 'warning' }} badge-pill text-black mr-2 mb-2">
                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                            {{ $order->payment_status == 'Payed' ? 'Card Payment' : 'Cash on Delivery' }}
                                        </span>
                                        <span class="badge badge-info badge-pill mr-2 mb-2 text-black">
                                            <i class="fas fa-store mr-1"></i>
                                            {{ ucfirst($order->type) }} order
                                        </span>
                                        <span
                                            class="badge badge-{{ $order->status == 'cancelled' ? 'danger' : 'primary' }} badge-pill mr-2 mb-2 text-black">
                                            <i class="fas fa-truck mr-1"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="bg-light p-3 rounded">
                                                <h6 class="font-weight-bold mb-3">
                                                    <i class="fas fa-truck mr-2"></i>Shipping Information
                                                </h6>
                                                <p class="mb-2">
                                                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                    <strong>Address:</strong> {{ $order->user_address }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="fas fa-phone text-primary mr-2"></i>
                                                    <strong>Contact:</strong> {{ $order->user_contact }}
                                                </p>
                                                <p class="mb-0">
                                                    <i class="fas fa-credit-card text-primary mr-2"></i>
                                                    <strong>Payment:</strong>
                                                    {{ $order->payment_status == 'Payed' ? 'Card Payment' : 'Cash On Delivery' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bg-light p-3 rounded h-100">
                                                <h6 class="font-weight-bold mb-3">
                                                    <i class="fas fa-palette mr-2"></i>Artist Information
                                                </h6>
                                                <p class="mb-2">
                                                    <i class="fas fa-user text-primary mr-2"></i>
                                                    <strong>Name:</strong> {{ $order->artist->name }}
                                                </p>
                                                <p class="mb-3">
                                                    <i class="fas fa-envelope text-primary mr-2"></i>
                                                    <strong>Email:</strong> {{ $order->artist->email }}
                                                </p>
                                                @if ($role==="admin")
                                                <p class="mb-2">
                                                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                    <strong>Address:</strong> {{ $order->artist->profile->address }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="font-weight-bold mb-3">
                                        <i class="fas fa-box-open mr-2"></i>Order Items
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-4">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Item</th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-right">Shipping</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="mr-3">
                                                                    <img src="{{ asset($item->img_src) }}"
                                                                        alt="{{ $item->item_name }}"
                                                                        class="img-fluid rounded border"
                                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                                </div>
                                                                <div>
                                                                    <p class="mb-0 font-weight-bold">{{ $item->item_name }}
                                                                    </p>
                                                                    <small class="text-muted">SKU:
                                                                        {{ $item->product_id }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">{{ number_format($item->price, 0) }} Rs</td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
                                                        <td class="text-right">{{number_format($item->total_price-($item->price*$item->quantity))}}</td>
                                                        <td class="text-right font-weight-bold">
                                                            {{ number_format($item->total_price, 0) }} Rs</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <td colspan="4" class="text-right font-weight-bold">Grand Total</td>
                                                    <td class="text-right font-weight-bold text-primary">
                                                        {{ number_format($order->items->sum('total_price'), 0) }} Rs
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    @if (!request()->is('artist/sales'))
                                        <div class="d-flex align-items-center justify-content-between">
                                            @if ($role !== 'admin' || in_array($order->status, ['completed']))
                                                <div class="status">
                                                    Status: <b>{{ $order->status }}</b>
                                                </div>
                                            @else
                                                <div class="status-form">
                                                    <form action="{{ route('admin.order.status', $order->id) }}"
                                                        method="POST" id="status-form-{{$order->id}}">
                                                        @csrf
                                                        <label class="d-flex gap-2 align-items-center">Status:
                                                            <select class="form-select" name="status" id="status-input"
                                                                onchange="document.getElementById('status-form-{{$order->id}}').submit()">
                                                                <option value="pending"
                                                                    {{ $order->status === 'pending' ? 'selected' : '' }}>
                                                                    pending</option>
                                                                <option value="in-progress"
                                                                    {{ $order->status === 'in-progress' ? 'selected' : '' }}>
                                                                    in-progress</option>
                                                                <option value="completed"
                                                                    {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                                    completed</option>
                                                            </select></label>
                                                    </form>
                                                </div>
                                            @endif

                                            @can('cancel order')
                                                @php
                                                    $canCancel = false;

                                                    if (
                                                        $role !== 'admin' &&
                                                        $order->status === 'pending' &&
                                                        $order->type === 'standard'
                                                    ) {
                                                        $canCancel = true;
                                                    } elseif ($role === 'admin' && $order->status !== 'completed') {
                                                        $canCancel = true;
                                                    } else {
                                                        $canCancel = false;
                                                    }
                                                @endphp

                                                @if ($canCancel && !request()->is('*/sales'))
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        <button class="btn btn-outline-danger"
                                                            onclick="cancelOrder('{{ route('order.cancel', $order->id) }}')">
                                                            <i class="fas fa-times-circle"></i> Cancel Order
                                                        </button>
                                                    </div>
                                                @else
                                                    <button class="btn btn-primary">{{ $order->status }}</button>
                                                @endif
                                            @endcan

                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
@include('Orders.modals.add-custom-request')
@push('scripts')
    <script>
        function cancelOrder(url) {
            Swal.fire({
                title: "Cancel Order!",
                text: "Are you sure you want to cancel this Order?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: "Yes",
                confirmButtonColor: "green",
                denyButtonText: `No`,
                customClass: {
                    popup: 'custom-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `${url}`
                } else if (result.isDenied) {
                    toastr.info('Order Remains Active!')
                }
            });
        }
    </script>
@endpush
