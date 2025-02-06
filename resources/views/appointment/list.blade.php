@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <link rel="stylesheet" href="{{ url('select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- Content Header -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Appointments List</h3>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Appointments List</h3>
            </div>
            <!-- Add Appointment Button for Patients -->
            @if (Auth::user()->user_type === 'patient')
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('appointment.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i> Add Appointment
                </a>
            </div>
            @endif
        </div>

        <div class="kt-portlet__body">
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending">Pending</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#confirmed">Confirmed</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cancelled">Cancelled</a></li>
            </ul>

            <div class="tab-content">
                <!-- All Appointments Tab -->
                <div class="tab-pane active" id="all">
                    <table class="table table-striped table-bordered table-hover kt_table_1">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Department</th>
                                <th>Date/Time</th>
                                <th>Status</th>
                                @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor') <th>Actions</th> @endif
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <!-- Patient Column -->
                                    <td>{{ $appointment->patient->name ?? 'N/A' }}</td>

                                    <!-- Doctor Column -->
                                    <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>

                                    <!-- Department Column: Now displayed for all user types -->
                                    <td>{{ $appointment->doctor->department ?? 'N/A' }}</td>

                                    <!-- Appointment Date/Time -->
                                    <td>{{ $appointment->appointment_date }} / {{ $appointment->time_slot }}</td>

                                    <!-- Status -->
                                    <td>{{ ucfirst($appointment->status) }}</td>

                                    <!-- Actions: Only for doctors and admins -->
                                    @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor')
                                    <td>
                                        <button type="button" class="btn btn-sm btn-clean btn-icon" data-toggle="modal" data-target="#statusModal" data-id="{{ $appointment->id }}" data-status="{{ $appointment->status }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                    </td>
                                    @endif

                                    <!-- Delete Action -->
                                    <td>
                                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Repeat similar structure for Pending, Confirmed, and Cancelled tabs -->
                    <!-- Pending Appointments Tab -->
    <div class="tab-pane" id="pending">
        <table class="table table-striped table-bordered table-hover kt_table_1">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor') <th>Actions</th> @endif
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->department ?? 'N/A' }}</td>
                        <td>{{ $appointment->appointment_date }} / {{ $appointment->time_slot }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor')
                        <td>
                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-toggle="modal" data-target="#statusModal" data-id="{{ $appointment->id }}" data-status="{{ $appointment->status }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        @endif
                        <td>
                            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Confirmed Appointments Tab -->
    <div class="tab-pane" id="confirmed">
        <table class="table table-striped table-bordered table-hover kt_table_1">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor') <th>Actions</th> @endif
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($confirmedAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->department ?? 'N/A' }}</td>
                        <td>{{ $appointment->appointment_date }} / {{ $appointment->time_slot }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor')
                        <td>
                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-toggle="modal" data-target="#statusModal" data-id="{{ $appointment->id }}" data-status="{{ $appointment->status }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        @endif
                        <td>
                            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cancelled Appointments Tab -->
    <div class="tab-pane" id="cancelled">
        <table class="table table-striped table-bordered table-hover kt_table_1">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor') <th>Actions</th> @endif
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cancelledAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->department ?? 'N/A' }}</td>
                        <td>{{ $appointment->appointment_date }} / {{ $appointment->time_slot }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        @if (Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor')
                        <td>
                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-toggle="modal" data-target="#statusModal" data-id="{{ $appointment->id }}" data-status="{{ $appointment->status }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        @endif
                        <td>
                            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('appointment.updateStatus') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Appointment Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="appointment-id">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="confirmed">Approve</option>
                            <option value="cancelled">Cancel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#statusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var appointmentId = button.data('id');
            var status = button.data('status');

            var modal = $(this);
            modal.find('#appointment-id').val(appointmentId);
            modal.find('#status').val(status);
        });
    </script>
@endsection
