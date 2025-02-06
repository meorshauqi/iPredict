@extends(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'doctor' ? 'layouts.master' : 'layouts.master')

@section('styles')
    <link href="{{ url('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Patients List</h3>
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
                        <h3 class="kt-portlet__head-title">Patients List</h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped table-bordered table-hover table-checkable kt_table_1" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>National ID</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            @if(Auth::user()->user_type === 'admin')
                                <th>Actions</th>
                                <th>Delete</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name ?? 'N/A' }}</td>
                                <td>{{ $user->patient?->ic ?? 'N/A' }}</td>
                                <td>{{ $user->patient?->address ?? 'N/A' }}</td>
                                <td>{{ $user->patient?->date_of_birth ?? 'N/A' }}</td>
                                <td>{{ ucfirst($user->patient?->gender ?? 'N/A') }}</td>
                                @if(Auth::user()->user_type === 'admin')
                                    <td>
                                        <span class="dropdown">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                                <i class="la la-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#notesModal"
                                                   data-user-name="{{ $user->name }}"
                                                   data-appointment-notes="{{ $user->appointments->first()?->notes ?? 'No notes available.' }}">
                                                    <i class="la la-eye"></i>Display
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('patients.destroy', $user->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Modal -->
    <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="notesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notesModalLabel">Appointment Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong><p id="modalNotesContent">Loading...</p></strong>
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
    @if(Auth::user()->user_type === 'admin')
        <script src="{{ url('adminpanel/assets/js/demo3/pages/crud/datatables/advanced/multiple-controls.js') }}" type="text/javascript"></script>
    @endif
    <script>
        // Handle displaying the notes modal dynamically
        $('#notesModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var userName = button.data('user-name');
            var notes = button.data('appointment-notes') || 'No notes available.';

            var modal = $(this);
            modal.find('.modal-title').text('Appointment Notes for ' + userName);
            modal.find('#modalNotesContent').text('Last appointment notes: ' + notes);
        });
    </script>
@endsection
