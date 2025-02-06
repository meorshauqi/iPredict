@extends('landing.layouts.app')

@section('title', 'iPredict')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Welcome to iPredict</h1>
                    <p>Let us predict your symptoms to enhance your healthcare experience.</p>
                    <div class="d-flex flex-column flex-md-row">
                        <a href="{{ route('login') }}" class="btn-get-started">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="{{ asset('landingPage/assets/img/front-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>Who We Are</h3>
                        <h2>We are dedicated to revolutionizing healthcare with a seamless and user-friendly platform.</h2>
                        <p>
                            Our mission is to bridge the gap between technology and healthcare, ensuring accurate predictions and streamlined processes for a healthier tomorrow. Whether you’re seeking consultations, managing symptoms, or staying informed, we are here to support your journey to better health.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Read More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('landingPage/assets/img/about.jpg') }}" class="img-fluid" alt="">

                </div>
            </div>
        </div>
    </section>

    <section id="values" class="values section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
            <p>What drives us to deliver the best healthcare solutions</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('landingPage/assets/img/values1.jpg') }}" class="img-fluid" alt="Compassionate Care">
                        <h3>Compassionate Care</h3>
                        <p>We prioritize patient well-being by ensuring that our platform is easy to use and focused on connecting patients with the right healthcare services.</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('landingPage/assets/img/values2.jpg') }}" class="img-fluid" alt="Innovation">
                        <h3>Innovation</h3>
                        <p>By integrating cutting-edge technology like disease prediction, we aim to revolutionize how patients and healthcare providers interact.</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('landingPage/assets/img/values3.jpg') }}" class="img-fluid" alt="Accessibility">
                        <h3>Accessibility</h3>
                        <p>We believe in making healthcare accessible to all by streamlining appointment booking and symptom management processes.</p>
                    </div>
                </div><!-- End Card Item -->

            </div>

        </div>

    </section>
    <!-- /Values Section -->
@endsection
