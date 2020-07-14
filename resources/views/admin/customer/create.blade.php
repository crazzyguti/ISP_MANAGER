@extends('layouts.client')


@section('content')
<section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

    <style>
      .map-container {
        height: 500px;
        width: 700px;
        position: relative;
      }

      .map-container iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
      }
    </style>

    <!--Google map-->
    <div id="map-container-google-1" class="z-depth-1 map-container mb-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3577.5940810491957!2d27.525080815700527!3d42.69675442176405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a68354e9906147%3A0x2601b4100c4da83b!2s8212%20Burgas!5e1!3m2!1sen!2sbg!4v1594639655639!5m2!1sen!2sbg" frameborder="0" style="border:0;" allowfullscreen aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!--Google Maps-->

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-lg-5 col-md-12 mb-0 mb-md-0">

        <h3 class="font-weight-bold">Contact Us</h3>

        <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quam sapiente
          molestiae
          numquam quas, voluptates omnis nulla ea odio quia similique corrupti magnam, doloremque laborum.</p>

        <p><span class="font-weight-bold mr-2">Email:</span><a href="">contact@mycompany.com</a></p>
        <p><span class="font-weight-bold mr-2">Phone:</span><a href="">+48 123 456 789</a></p>

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-7 col-md-12 mb-4 mb-md-0">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-md-6">

            <!-- Material outline input -->
            <div class="md-form md-outline mb-0">
              <input type="text" id="form-first-name" class="form-control">
              <label for="form-first-name">First name</label>
            </div>

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6">

            <!-- Material outline input -->
            <div class="md-form md-outline mb-0">
              <input type="text" id="form-last-name" class="form-control">
              <label for="form-last-name">Last name</label>
            </div>

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

        <!-- Material outline input -->
        <div class="md-form md-outline mt-3">
          <input type="email" id="form-email" class="form-control">
          <label for="form-email">E-mail</label>
        </div>

        <!-- Material outline input -->
        <div class="md-form md-outline">
          <input type="text" id="form-subject" class="form-control">
          <label for="form-subject">Subject</label>
        </div>

        <!--Material textarea-->
        <div class="md-form md-outline mb-3">
          <textarea id="form-message" class="md-textarea form-control" rows="3"></textarea>
          <label for="form-message">How we can help?</label>
        </div>

        <button type="submit" class="btn btn-info btn-sm ml-0">Submit<i class="far fa-paper-plane ml-2"></i></button>

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->


  </section>
  <!--Section: Content-->

@endsection
