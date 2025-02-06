@extends('layouts.master')

@section('content')
<div class="container my-4"> <!-- Adjusted margin to reduce spacing -->
    <div class="row">
        <!-- Welcome Section -->
        <div class="col-md-12 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Welcome, {{ $user->name }}</h4>
                        <p class="mb-0">Your personal health dashboard overview.</p>
                    </div>
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Appointments Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5>Your Scheduled Appointments</h5>
                </div>
                <div class="card-body">
                    @if (isset($roleData['appointments']) && $roleData['appointments']->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roleData['appointments'] as $appointment)
                                <tr>
                                    <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->doctor->department ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No upcoming appointments found.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5>Appointment Calendar</h5>
                </div>
                <div class="card-body">
                    <div id="appointmentCalendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
