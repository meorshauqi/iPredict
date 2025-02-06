@extends('layouts.master')
@section('content')
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Content Head -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Dashboard</h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <!-- begin:: Content Container-->
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <!-- Welcome Section -->
            <div class="col-md-12 mb-4">
                <div class="card bg-dark text-white shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Welcome, {{ $user->name }}</h4>
                            @if (auth()->user()->user_type === 'patient')
                                <p class="mb-0">Your personal health dashboard overview.</p>
                            @endif
                            @if (auth()->user()->user_type === 'doctor' || auth()->user()->user_type === 'admin' )
                                <p class="mb-0">Your personal dashboard overview.</p>
                            @endif
                        </div>
                        <i class="fas fa-user-circle fa-3x"></i>
                    </div>
                </div>
            </div>

            <!-- Patient Dashboard -->
            @if (auth()->user()->user_type === 'patient')
            <div class="col-md-6 mb-3">
                <div class="card shadow mb-4">
                    <div class="card-header bg-light text-dark">
                        <h5>Booked Appointments Status</h5>
                    </div>
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        @if (isset($roleData['appointments']) && $roleData['appointments']->isNotEmpty())
                            <table id="appointmentsTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Date</th>
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
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No upcoming appointments found.</p>
                        @endif
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header bg-light text-dark">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('appointment.create') }}" class="btn btn-primary mb-2">
                                <i class="fa fa-calendar-plus"></i> Book an Appointment
                            </a>
                            <a href="{{ route('symptom.checker') }}" class="btn btn-danger mb-2">
                                <i class="fa fa-search"></i> Symptom Checker
                            </a>
                            <a href="{{ route('profile.personal') }}" class="btn btn-success">
                                <i class="fa fa-user-edit"></i> Update Personal Information
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-light text-dark">
                        <h5>Calendar</h5>
                    </div>
                    <div class="card-body">
                        <div id="appointmentCalendar"></div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Doctor Dashboard -->
            @if (auth()->user()->user_type === 'doctor')
            <div class="col-md-12 mb-4">
                <div class="row d-flex align-items-stretch">
                    <!-- All Pending Appointments -->
                    <div class="col-md-8 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-light text-dark">
                                <h5>All Pending Appointments</h5>
                            </div>
                            <div class="card-body" style="overflow-y: auto;">
                                <table id="appointmentsTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Doctor</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roleData['pendingAppointments'] as $appointment)
                                            <tr>
                                                <td>{{ $appointment['patient']['name'] ?? 'N/A' }}</td>
                                                <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                                                <td>{{ $appointment->time_slot }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $appointment['notes'] ?? 'No notes available' }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Donut Chart Section -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-light text-dark">
                                <h5>Top Departments</h5>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Graphs Section -->
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-light text-dark">
                                <h5>New Patients (Last 12 Months)</h5>
                            </div>
                            <div class="card-body">
                                <div id="genderChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            {{-- <div class="col-md-6">
                <!-- Calendar Section -->
                <div class="card shadow mb-4" style="min-height: 300px;">
                    <div class="card-header bg-info text-white">
                        <h5>Calendar</h5>
                    </div>
                    <div class="card-body">
                        <div id="appointmentCalendar"></div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                            <div class="card-header bg-warning text-dark">
                                <h5>Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('appointment.list') }}" class="btn btn-primary mb-2">
                                        <i class="fa fa-calendar-plus"></i> Appointment List
                                    </a>
                                    <a href="{{ route('patient.list') }}" class="btn btn-info mb-2">
                                        <i class="fa fa-search"></i> Patient List
                                    </a>
                                    <a href="{{ route('profile.personal') }}" class="btn btn-secondary">
                                        <i class="fa fa-user-edit"></i> Update Personal Information
                                    </a>
                                </div>
                            </div>
                        </div>
                        --}}
            <!-- Admin Dashboard -->
            @if (auth()->user()->user_type === 'admin')

            <div class="col-md-12 mb-4">
                <div class="row d-flex align-items-stretch">
                    <!-- All Pending Appointments -->
                    <div class="col-md-8 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-light text-dark">
                                <h5>All Pending Appointments</h5>
                            </div>
                            <div class="card-body" style="overflow-y: auto;">
                                <table id="appointmentsTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Doctor</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roleData['pendingAppointments'] as $appointment)
                                            <tr>
                                                <td>{{ $appointment['patient']['name'] ?? 'N/A' }}</td>
                                                <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                                                <td>{{ $appointment->time_slot }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $appointment['notes'] ?? 'No notes available' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Donut Chart Section -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-light text-dark">
                                <h5>Top Departments</h5>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Graphs Section -->
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-light text-dark">
                                <h5>New Users (Last 12 Months)</h5>
                            </div>
                            <div class="card-body">
                                <div id="newRegistrationsChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- end:: Content Container-->
</div>
<!-- end:: Content -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Initialize FullCalendar
        var calendarEl = document.getElementById('appointmentCalendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @foreach ($roleData['appointments'] ?? [] as $appointment)
                    {
                        title: 'Appointment with Dr. {{ $appointment->doctor->user->name ?? "N/A" }}',
                        start: '{{ $appointment->appointment_date }}T{{ $appointment->time_slot }}',
                    },
                    @endforeach
                ],
            });
            calendar.render();
        }

        // Data for New Doctors and Patients
        const newDoctorsData = {!! json_encode(array_values($roleData['newDoctors'] ?? [])) !!};
        const newPatientsData = {!! json_encode(array_values($roleData['newPatients'] ?? [])) !!};
        const newLabels = {!! json_encode(array_keys($roleData['newDoctors'] ?? [])) !!};

        // Convert numeric month indices to month names
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const categories = newLabels.map(month => months[month - 1]);

        // Combined Chart
        if (document.querySelector("#newRegistrationsChart")) {
            const combinedChart = new ApexCharts(document.querySelector("#newRegistrationsChart"), {
                series: [
                    {
                        name: 'New Doctors',
                        data: newDoctorsData
                    },
                    {
                        name: 'New Patients',
                        data: newPatientsData
                    }
                ],
                chart: {
                    height: 350,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: categories
                },
                colors: ['#1E90FF', '#FF69B4'],
                legend: {
                    position: 'top'
                },
                title: {
                    text: 'New Users Over the Last 12 Months',
                    align: 'center'
                },
            });
            combinedChart.render();
        }


        $(document).ready(function() {
            $('#doctorTable').DataTable({
                pageLength: 5 // Display 5 entries per page
            });
            $('#patientTable').DataTable({
                pageLength: 5 // Display 5 entries per page
            });
            $('#appointmentsTable').DataTable({
                pageLength: 5 // Display 5 entries per page
            });
        });

        var departmentNames = @json(array_keys($roleData['topDepartments'] ?? []));
        var departmentCounts = @json(array_values($roleData['topDepartments'] ?? []));

        var options = {
            series: departmentCounts.length > 0 ? departmentCounts : [0], // Default value if empty
            chart: {
                type: 'donut',
            },
            labels: departmentNames.length > 0 ? departmentNames : ['No Data'], // Default label
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var genderChartEl = document.getElementById('genderChart');
        if (genderChartEl) {
            var genderData = {!! json_encode($roleData['genderData'] ?? []) !!};
            console.log('Gender Data:', genderData);

            var malePatients = [];
            var femalePatients = [];

            // Populate data arrays for male and female patients
            for (var month = 1; month <= 12; month++) {
                malePatients.push(genderData['Male'][month] || 0);  // Default to 0 if no data
                femalePatients.push(genderData['Female'][month] || 0);  // Default to 0 if no data
            }

            // Set up chart options
            var options = {
                series: [{
                    name: 'Male Patients',
                    data: malePatients
                }, {
                    name: 'Female Patients',
                    data: femalePatients
                }],
                chart: {
                    height: 350,
                    type: 'area',  // Change from 'bar' to 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                yaxis: {
                    title: {
                        text: 'Number of Patients'
                    }
                },
                fill: {
                    opacity: 0.4  // Adjust transparency for area chart
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " Patients";
                        }
                    }
                },
                colors: ['#36a2eb', '#ff6384'], // Blue for Male, Pink for Female
                legend: {
                    position: 'top'
                },
                title: {
                    text: 'Gender Distribution of Patients Over the Last 12 Months',
                    align: 'center'
                },
            };

            // Render the chart
            var chart = new ApexCharts(genderChartEl, options);
            chart.render();
        }

    });
</script>
@endsection

