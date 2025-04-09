@extends('layouts.' . $role . 'Layout.layout')
@section('page')
    <div class="container py-5">

        @if ($orders->isEmpty())
            <div class="card shadow-sm mt-2">
                <div class="card-body text-center">
                    <h5 class="card-title">No Order Placed!</h5>
                    <p class="card-text">It looks like no orders have been placed yet!</p>
                    @if($role!=='admin')
                    <a href="{{ route($role . '.store') }}" class="btn btn-primary">Browse Products</a>
                    @endif
                </div>
            </div>
        @else
            <div class="row" id="ordersAccordion">
                @foreach ($orders as $order)
                    <div class="card shadow-sm mb-3 col-6">
                        <div class="card-header bg-custom" id="heading{{ $order->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-light font-weight-bold" type="button"
                                            data-toggle="collapse" data-target="#collapse{{ $order->id }}"
                                            aria-expanded="true" aria-controls="collapse{{ $order->id }}">
                                            Order #{{ $order->id }} - {{ $order->order_date }}
                                        </button>
                                    </h5>
                                    <div class="d-flex mt-2">
                                        <span
                                            class="badge badge-{{ $order->payment_status == 'Payed' ? 'success' : 'warning' }}">
                                            {{ $order->payment_status == 'Payed' ? 'Payed' : 'Cash on Delivery' }}
                                        </span>
                                        <span class="badge badge-info ml-2">
                                            {{ $order->type }} order
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="res-sub text-light">Total:
                                        {{ number_format($order->items->sum('total_price')) }} Rs</div>
                                </div>
                            </div>
                        </div>

                        <div id="collapse{{ $order->id }}" class="collapse show"
                            aria-labelledby="heading{{ $order->id }}" data-parent="#ordersAccordion">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h6>Shipping Information</h6>
                                        <p class="mb-1"><strong>Address:</strong> {{ $order->user_address }}</p>
                                        <p class="mb-1"><strong>Contact:</strong> {{ $order->user_contact }}</p>
                                        <p class="mb-1"><strong>Payment Method:</strong>
                                            {{ $order->payment_status == 'Payed' ? 'Card Payment' : 'Cash On Delivery' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Artist Information</h6>
                                        <p class="mb-1"><strong>Name:</strong> {{ $order->artist->name }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $order->artist->email }}</p>
                                    </div>
                                </div>

                                <h6>Order Items</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-custom">
                                            <tr>
                                                <th class="min-width-200 text-light">Item</th>
                                                <th class="text-light">Price</th>
                                                <th class="text-light">Qty</th>
                                                <th class="text-light">Shipping</th>
                                                <th class="text-light">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td style="min-width:10rem">
                                                        <div class="d-flex gap-1 align-items-center">
                                                            <img src="{{ asset($item->img_src) }}"
                                                                alt="{{ $item->item_name }}" class="img-fluid rounded mr-3"
                                                                style="width: 60px; height: 60px; object-fit: contain;">
                                                            <div>
                                                                <b>
                                                                    <p class="mb-0 text-truncate">{{ $item->item_name }}
                                                                    </p>
                                                                </b>
                                                                <small class="text-muted">Item ID:
                                                                    {{ $item->product_id }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-label="Price">{{ number_format($item->price, 2) }}Rs</td>
                                                    <td data-label="Qty">{{ $item->quantity }}</td>
                                                    <td data-label="Shipping">250Rs</td>
                                                    <td data-label="Total">${{ number_format($item->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-custom">
                                                <td colspan="4" class="text-right font-weight-bold text-light">Grand
                                                    Total</td>
                                                <td class="font-weight-bold text-light">
                                                    ${{ number_format($order->items->sum('total_price'), 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button class="btn btn-danger" onclick="cancelOrder('{{route('order.cancel',$order->id)}}')">Cancel
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        function cancelOrder(url) {
            Swal.fire({
                title: "Delete Selected!",
                text: "Are you sure you want to cancel this order?",
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
                    toastr.info('User deletion stopped!')
                }
            });
        }
    </script>
@endpush
