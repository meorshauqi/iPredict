@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
@endsection

@section('content')
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container kt-container--fluid">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Add Doctor</h3>
                </div>
            </div>
        </div>

        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="offset-2 col-md-8">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Add Doctor</h3>
                            </div>
                        </div>

                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="kt-form kt-form--label-right" action="{{ route('doctors.store') }}" method="POST">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-last">
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                        <div class="alert-text">You can add a new doctor using this form.</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heading"></i></span></div>
                                        <input id="first_name" class="form-control" type="text" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                        <input id="email" class="form-control" type="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                                        <input id="password" class="form-control" type="password" name="password" placeholder="Enter password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
                                        <input id="mobile" class="form-control" type="number" name="mobile" placeholder="Enter mobile number" value="{{ old('mobile') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Departments</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-h-square"></i></span></div>
                                        <select id="department" class="form-control" name="department">
                                            <option value="" disabled selected>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department }}" {{ old('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <input type="submit" value="Submit" class="btn-lg btn-primary">
                                        <input type="reset" class="btn-lg btn-danger" value="Cancel">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
