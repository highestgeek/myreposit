@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <!-- Add other columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->shipping_fullname }}</td>
                    <td>{{ $order->grand_total }}</td>
                    <td>{{ $order->status }}</td>

                    <td>
                        @if ($order->status === 'pending')
                            <form action="{{ route('update-status', $order->id) }}" method="post">
                                @csrf
                                <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button>
                                <button type="submit" name="status" value="declined" class="btn btn-danger">Decline</button>
                            </form>
                        @else
                            <!-- You can add logic here for other status-specific actions if needed -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
