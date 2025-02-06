@extends('layouts.master')

@section('styles')
    <link href="{{ url('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Doctors List</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            @if(session()->has('success'))
                <div class="alert alert-light alert-elevate" role="alert">
                    <div class="alert-icon"><i class="flaticon2-check-mark kt-font-success"></i></div>
                    <div class="alert-text">{{ session()->get('success') }}</div>
                </div>
            @endif

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">Doctors List</h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped table-bordered table-hover kt_table_1" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Actions</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->user->name ?? 'N/A' }}</td>
                                <td>{{ $doctor->user->email ?? 'N/A' }}</td>
                                <td>+60{{ $doctor->user->phone ?? 'N/A' }}</td>
                                <td>{{ $doctor->department ?? 'N/A' }}</td>
                                <td>
                                    <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                            <i class="la la-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#viewDetailsModal"
                                               data-doctor-name="{{ $doctor->user->name }}"
                                               data-doctor-registered="{{ $doctor->user->created_at->format('d M Y, h:i A') }}">
                                                <i class="la la-eye"></i> View Details
                                            </a>
                                        </div>
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="return confirm('Are you sure?')">
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

    <!-- View Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDetailsModalLabel">Doctor Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modalDoctorName"></span></p>
                    <p><strong>Registered At:</strong> <span id="modalDoctorRegistered"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('adminpanel/assets/js/demo3/pages/crud/datatables/advanced/multiple-controls.js') }}" type="text/javascript"></script>
    <script>
        // Handle displaying the View Details modal dynamically
        $('#viewDetailsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var doctorName = button.data('doctor-name');
            var doctorRegistered = button.data('doctor-registered');

            var modal = $(this);
            modal.find('#modalDoctorName').text(doctorName);
            modal.find('#modalDoctorRegistered').text(doctorRegistered);
        });
    </script>
@endsection
