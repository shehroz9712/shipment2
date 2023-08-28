@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Shipment</div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $shipment->id) }}" method="POST">
                            @csrf <!-- CSRF protection -->
                            @method('PUT') <!-- Use the PUT method for updates -->
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    value="{{ $shipment->full_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $shipment->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="shipment_address" class="form-label">Shipment Address</label>
                                <textarea class="form-control" id="shipment_address" name="shipment_address" rows="4" required>{{ $shipment->shipment_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="{{ $shipment->contact }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="track_id" class="form-label">Track ID</label>
                                <input type="text" class="form-control" id="track_id" name="track_id"
                                    value="{{ $shipment->track_id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="rate_charges" class="form-label">Rate Charges</label>
                                <input type="number" step="0.01" class="form-control" id="rate_charges"
                                    name="rate_charges" value="{{ $shipment->rate_charges }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
