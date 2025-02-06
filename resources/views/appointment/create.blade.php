@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <link rel="stylesheet" href="{{ url('select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css" />
    <style>
        /* Styling for the calendar */
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        .fc-daygrid-day-number {
            font-size: 14px;
            font-weight: bold;
        }

        .fc-daygrid-day {
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .fc-daygrid-day:hover {
            background-color: #f1f1f1;
        }

        .fc-daygrid-day.fc-day-today {
            background-color: #f5f5f5;
        }

        .fc-daygrid-day.fc-day-other-month {
            opacity: 0.6;
        }

        .fc-daygrid-day.fc-day-sat, .fc-daygrid-day.fc-day-sun {
            background-color: #f9f9f9;
        }

        .fc-event {
            background-color: #f05d5e !important;
            color: #fff;
            border-radius: 5px;
        }

        .form-group label {
            font-weight: bold;
        }

        .digital-clock {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e9e7e7;
            background-color: #333 ;
            padding: 10px;
            border-radius: 2px;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Add Appointment</h3>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <!-- Form Section -->
            <div class="col-md-8">
                <form action="{{ route('appointment.store') }}" method="POST">
                    @csrf
                    @if (session('success') || session('error') || session('suggested_slots') || session('booked_details'))
                    <!-- Modal Trigger (Hidden) -->
                    <button type="button" id="errorModalTrigger" class="d-none" data-toggle="modal" data-target="#errorModal"></button>

                    <!-- Modal Structure -->
                    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notificationModalLabel">
                                        @if(session('success'))
                                            Success
                                        @elseif(session('error'))
                                            Appointment Conflict
                                        @endif
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(session('success'))
                                        {{ session('success') }}
                                    @elseif(session('error'))
                                        {{ session('error') }}
                                        @if(session('booked_details'))
                                            Suggested Slots: Choose another date and time than <strong>{{ session('booked_details') }}</strong>
                                        @endif
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('modal_message'))
                    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessageTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalMessageTitle">Doctor Reassignment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ session('modal_message') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Add Appointment</h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!-- Patient Name -->
                            <div class="form-group">
                                <label>Patient Name</label>
                                <input type="text" name="patient_name" class="form-control" value="{{ $patientName }}" readonly>
                            </div>
                            <!-- Department -->
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" id="department" name="department">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department }}">{{ $department }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Doctor -->
                            <div class="form-group">
                                <label>Doctor</label>
                                <select class="form-control" name="doctor_id" id="doctor">
                                    <option value="">Select Doctor</option>
                                </select>
                            </div>
                            <!-- Date -->
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                    <input type="text" name="appointment_date" class="form-control" id="appointment_date" placeholder="Select Date">
                                </div>
                            </div>
                            <!-- Time Slot -->
                            <div class="form-group">
                                <label>Time Slot</label>
                                <div class="input-group date" id="timeSlotPicker" data-target-input="nearest">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="time_slot" class="form-control datetimepicker-input" data-target="#timeSlotPicker" placeholder="Select Time Slot" />
                                    <div class="input-group-append" data-target="#timeSlotPicker" data-toggle="datetimepicker">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Notes -->
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="notes" placeholder="Enter any remarks"></textarea>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Calendar Section -->
            <div class="col-md-4">
                <!-- Calendar Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Check for Availability</h4><br>
                        <div id="calendar"></div>
                    </div>
                </div>

                <!-- Digital Clock Card -->
                <div class="card">
                    <div class="card-body">
                        <h4>Current Date and Time</h4>
                        <div id="digitalClock" class="digital-clock"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var bookedSlots = @json($bookedSlots);

    console.log(bookedSlots); // Debug: Check the format of bookedSlots

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridDay', // Day view with time slots
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialDate: moment().format('YYYY-MM-DD'), // Start with today's date
        events: bookedSlots, // Use booked slots data
        eventColor: '#f05d5e', // Red color for booked slots
        allDaySlot: false, // Disable all-day slots
        slotMinTime: "08:00:00", // Earliest slot (8:00 AM)
        slotMaxTime: "18:00:00", // Latest slot (6:00 PM)
        selectable: true, // Allow selecting slots
        select: function (info) {
            // Fill form inputs when a slot is selected
            document.getElementById('appointment_date').value = info.startStr.split('T')[0];
            document.getElementById('time_slot').value = moment(info.start).format('hh:mm A'); // 12-hour format with AM/PM
        },
        eventTimeFormat: {
            // Customize the time format for events
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short' // Add AM/PM to the time format
        },
        eventContent: function (arg) {
            return { html: `<span style="color:white;">${arg.event.title}</span>` };
        }
    });

    calendar.render();
});

        function updateDigitalClock() {
            const now = new Date();

            // Format date: YYYY-MM-DD
            const date = now.toLocaleDateString(undefined, {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Format time: HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const time = `${hours}:${minutes}:${seconds}`;

            // Update the clock with both date and time
            document.getElementById('digitalClock').textContent = `${date} | ${time}`;
        }

        // Update the clock every second
        setInterval(updateDigitalClock, 1000);

        // Initialize the clock on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateDigitalClock();
        });

        flatpickr("#appointment_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
        });

        // Store all doctors grouped by department
        var doctorsByDepartment = @json($doctors->groupBy('department')->toArray());

        // Update the doctor list based on the selected department
        document.getElementById('department').addEventListener('change', function () {
            var selectedDepartment = this.value;
            var doctorSelect = document.getElementById('doctor');

            // Clear the existing options
            doctorSelect.innerHTML = '<option value="">Select Doctor</option>';

            if (selectedDepartment && doctorsByDepartment[selectedDepartment]) {
                doctorsByDepartment[selectedDepartment].forEach(function (doctor) {
                    var option = document.createElement('option');
                    option.value = doctor.user_id;
                    option.text = doctor.user.name;
                    doctorSelect.appendChild(option);
                });
            }
        });

        $(function () {
            $('#timeSlotPicker').datetimepicker({
                format: 'LT', // Format for 12-hour clock with AM/PM
                stepping: 30, // 30-minute intervals
                icons: {
                    time: 'fa fa-clock',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-calendar-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times',
                },
                allowInputToggle: true, // Allow toggling input field
                minDate: moment().startOf('day').hour(8), // Set minimum time to 8:00 AM
                maxDate: moment().startOf('day').hour(18).minute(0), // Set maximum time to 6:00 PM
            });

            // Show the time picker when the input field is focused
            $('#timeSlotPicker').on('focus', function () {
                $(this).datetimepicker('show');
            });
        });


        // Populate doctors based on department
        document.getElementById('department').addEventListener('change', function () {
            var selectedDepartment = this.value;
            var doctorSelect = document.getElementById('doctor');
            doctorSelect.innerHTML = '<option value="">Select Doctor</option>';

            if (selectedDepartment) {
                var doctors = @json($doctors->groupBy('department')->toArray());
                doctors[selectedDepartment]?.forEach(function (doctor) {
                    var option = document.createElement('option');
                    option.value = doctor.id;
                    option.text = doctor.user.name;
                    doctorSelect.appendChild(option);
                });
            }
        });

        // Modal display for errors and suggested slots
        $(document).ready(function () {
            if ($('#notificationModal').length) {
                $('#notificationModal').modal('show');
            }
        });

</script>
@endsection
