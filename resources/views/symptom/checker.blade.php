@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <link rel="stylesheet" href="{{ url('select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css" />

    <style>
        .symptom-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            max-height: 300px;
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .symptom-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .symptom-card.selected {
            background-color: #d42c2c;
            color: #fff;
            border-color: #ffffff;
            transform: scale(1.1);
        }

        .symptom-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .submit-button {
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        .instructions {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        .checker-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container kt-container--fluid">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Symptom Checker</h3>
                </div>
            </div>
        </div>

        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="checker-container">
                        <h2 class="text-center mb-4">What symptoms do you have?</h2>
                        <p class="instructions">Please select more than one symptoms for better prediction.</p>

                        <input type="text" id="searchBar" class="form-control mb-3" placeholder="Search for symptoms...">

                        <div id="symptomGrid" class="symptom-grid">
                            @foreach($symptoms as $symptom)
                                <div class="symptom-card" data-symptom="{{ $symptom->name }}">
                                    {{ str_replace('_', ' ', $symptom->name) }}
                                </div>
                            @endforeach
                        </div>
                        <button id="submitSymptoms" class="btn btn-primary submit-button" disabled>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="predictionModal" tabindex="-1" role="dialog" aria-labelledby="predictionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="predictionModalLabel">Predicted Disease</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="predictedDisease"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="createAppointment">Create Appointment</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchBar = document.getElementById('searchBar');
        const symptomCards = document.querySelectorAll('.symptom-card');

        searchBar.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();

            symptomCards.forEach(card => {
                const symptomName = card.getAttribute('data-symptom').toLowerCase();
                if (symptomName.includes(searchTerm)) {
                    card.style.display = ''; // Show the card
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        });

        const symptomGrid = document.getElementById('symptomGrid');
        const submitButton = document.getElementById('submitSymptoms');
        const selectedSymptoms = new Set();

        // Add click event listeners to each symptom card
        document.querySelectorAll('.symptom-card').forEach(card => {
            card.addEventListener('click', () => {
                const symptom = card.getAttribute('data-symptom');
                if (card.classList.contains('selected')) {
                    card.classList.remove('selected');
                    selectedSymptoms.delete(symptom);
                } else {
                    card.classList.add('selected');
                    selectedSymptoms.add(symptom);
                }
                updateSubmitButton();
            });
        });

        function updateSubmitButton() {
            submitButton.disabled = selectedSymptoms.size === 0;
        }

        submitButton.addEventListener('click', () => {
            const payload = {};
            selectedSymptoms.forEach(symptom => {
                payload[symptom] = 1;
            });

            fetch('http://127.0.0.1:5000/predict', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const predictedDisease = document.getElementById('predictedDisease');
                    predictedDisease.innerHTML = `
                        <strong>Disease:</strong> ${data.predicted_disease}<br><br>
                        Based on the prediction, we recommend visiting the <strong>${data.department}</strong> department.
                    `;
                    $('#predictionModal').modal('show');
                } else {
                    alert(`Error: ${data.message}`);
                }
            })
            .catch(() => {
                alert('Error: Unable to fetch prediction.');
            });
        });

        document.getElementById('createAppointment').addEventListener('click', () => {
            window.location.href = '{{ route("appointment.create") }}';
        });
    });
</script>
@endsection
