@extends('layouts.' . $role . 'Layout.layout')
@section('page')
    <div class="pt-5 px-2">
        @if ($orders->isEmpty())
            <div class="card shadow-sm mt-2">
                <div class="card-body text-center">
                    <h5 class="card-title">No Order Placed!</h5>
                    <p class="card-text">It looks like no orders have been placed yet!</p>
                    @if($role !== 'admin')
                        <a href="{{ route($role . '.store') }}" class="btn btn-primary">Browse Products</a>
                    @endif
                </div>
            </div>
        @else
            <div class="row" id="ordersAccordion">
                @foreach ($orders as $order)
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-custom" id="heading{{ $order->id }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">
                                            <button class="btn btn-link text-light font-weight-bold text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse{{ $order->id }}"
                                                aria-expanded="true" aria-controls="collapse{{ $order->id }}">
                                                Order #{{ $order->id }} - {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}
                                            </button>
                                        </h5>
                                        <div class="d-flex mt-2">
                                            <span class="badge badge-{{ $order->payment_status == 'Payed' ? 'success' : 'warning' }}">
                                                {{ $order->payment_status == 'Payed' ? 'Paid' : 'Cash on Delivery' }}
                                            </span>
                                            <span class="badge badge-info ml-2">
                                                {{ ucfirst($order->type) }} order
                                            </span>
                                            <span class="badge badge-{{ $order->status == 'cancelled' ? 'danger' : 'primary' }} ml-2">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-light">Total: {{ number_format($order->items->sum('total_price')) }} Rs</div>
                                    </div>
                                </div>
                            </div>

                            <div id="collapse{{ $order->id }}" class="collapse show"
                                aria-labelledby="heading{{ $order->id }}" data-parent="#ordersAccordion">
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
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
                                        <table class="table table-bordered">
                                            <thead class="bg-custom">
                                                <tr>
                                                    <th class="text-light">Item</th>
                                                    <th class="text-light">Price</th>
                                                    <th class="text-light">Qty</th>
                                                    <th class="text-light">Shipping</th>
                                                    <th class="text-light">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ asset($item->img_src) }}"
                                                                    alt="{{ $item->item_name }}" class="img-fluid rounded mr-3"
                                                                    style="width: 60px; height: 60px; object-fit: contain;">
                                                                <div>
                                                                    <p class="mb-0 font-weight-bold">{{ $item->item_name }}</p>
                                                                    <small class="text-muted">Item ID: {{ $item->product_id }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ number_format($item->price, 2) }} Rs</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>250 Rs</td>
                                                        <td>{{ number_format($item->total_price, 2) }} Rs</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-custom">
                                                    <td colspan="4" class="text-right font-weight-bold text-light">Grand Total</td>
                                                    <td class="font-weight-bold text-light">
                                                        {{ number_format($order->items->sum('total_price'), 2) }} Rs</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>


                                    @can('cancel order')
                                    @if (!auth()->user()->sales->contains('id',$order->id))
                                    <button class="btn btn-danger" onclick="cancelOrder('{{ route('order.cancel', $order->id) }}')">
                                        Cancel Order
                                    </button>
                                    @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="d-flex justify-content-center pt-5 pb-0">
            {{$orders->links()}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function cancelOrder(url) {
            Swal.fire({
                title: "Cancel Order",
                text: "Are you sure you want to cancel this order?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: "Yes, Cancel",
                confirmButtonColor: "#dc3545",
                denyButtonText: `No`,
                customClass: {
                    popup: 'custom-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                } else if (result.isDenied) {
                    toastr.info('Order cancellation stopped!');
                }
            });
        }
    </script>
@endpush
