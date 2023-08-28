@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">View Shipment</div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{ $shipment->id }}</td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $shipment->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $shipment->email }}</td>
                            </tr>
                            <tr>
                                <th>Shipment Address</th>
                                <td>{{ $shipment->shipment_address }}</td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td>{{ $shipment->contact }}</td>
                            </tr>
                            <tr>
                                <th>Track ID</th>
                                <td>{{ $shipment->track_id }}</td>
                            </tr>
                            <tr>
                                <th>Rate Charges</th>
                                <td>{{ $shipment->rate_charges }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
