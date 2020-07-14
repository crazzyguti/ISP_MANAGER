@extends('layouts.client')
@section('css')
<style>
    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection
@section('content')
<div class="container">

    <!--Section: Jumbotron-->
    <section class="card wow fadeIn"
      style="background-image: url({{asset('images/client/bluebg.jpg')}})">

      <!-- Content -->
      <div class="card-body text-white text-center py-5 px-5 my-5">

        <h1 class="mb-4">
          <strong>Learn Bootstrap 4 with MDB</strong>
        </h1>
        <p>
          <strong>Best & free guide of responsive web design</strong>
        </p>
        <p class="mb-4">
          <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and written
            versions available. Create your own, stunning website.</strong>
        </p>
        <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/"
          class="btn btn-outline-white btn-lg">Start free tutorial  <i class="fas fa-graduation-cap ml-2"></i>
        </a>

      </div>
      <!-- Content -->
    </section>
    <!--Section: Jumbotron-->

    <hr class="my-5">

    <!--Section: Cards-->
    <section class="text-center">

      <!--Grid row-->
      <div class="row mb-4 wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <!--Card-->
          <div class="card text-white bg-dark mb-3">

            <!--Card image-->
            <div class="view overlay">
              <div class="embed-responsive embed-responsive-16by9 rounded-top">
                <iframe src="https://www.youtube.com/embed/mr_xfcOe7Lo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title bg-dark text-white">как работи Оптичен интернет и какво представлява</h4>
              <!--Text-->
              <p class="card-text bg-dark text-white">
                <strong>
                 Определно бъдещето принадлежи на оптичната интернет връзка.
                 Голяма част от хората обаче все още не знаят какво представлява тя и не осъзнават каква полза може да им донесе тази нова технология.
                </strong>
              </p>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="https://mdbootstrap.com/wp-content/uploads/2017/11/brandflow-tutorial-fb.jpg"
                class="card-img-top" alt="">
              <a href="https://mdbootstrap.com/education/tech-marketing/automated-app-introduction/" target="_blank">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title">Bootstrap Automation</h4>
              <!--Text-->
              <p class="card-text">Learn how to create a smart website which learns your user and reacts properly to
                his behavior.</p>
              <a href="https://mdbootstrap.com/education/tech-marketing/automated-app-introduction/" target="_blank"
                class="btn btn-primary btn-md">Start tutorial
                <i class="fas fa-play ml-2"></i>
              </a>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="https://mdbootstrap.com/wp-content/uploads/2018/01/push-fb.jpg" class="card-img-top" alt="">
              <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title">Push notifications</h4>
              <!--Text-->
              <p class="card-text">Push messaging provides a simple and effective way to re-engage with your users
                and in this
                tutorial you'll learn how to add push notifications to your web app</p>
              <a href="https://mdbootstrap.com/education/tech-marketing/web-push-introduction/" target="_blank"
                class="btn btn-primary btn-md">Start
                tutorial
                <i class="fas fa-play ml-2"></i>
              </a>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row mb-4 wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-angular.jpg" class="card-img-top"
                alt="">
              <a href="https://mdbootstrap.com/angular/" target="_blank">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title">MDB with Angular</h4>
              <!--Text-->
              <p class="card-text">Built with Angular 5, Bootstrap 4 and TypeScript. CLI version available. </p>
              <a href="https://mdbootstrap.com/angular/" target="_blank" class="btn btn-primary btn-md">Free download
                <i class="fas fa-download ml-2"></i>
              </a>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-react.jpg" class="card-img-top"
                alt="">
              <a href="https://mdbootstrap.com/react/" target="_blank">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title">MDB with React</h4>
              <!--Text-->
              <p class="card-text">Based on the latest Bootstrap 4 and React 16. </p>
              <a href="https://mdbootstrap.com/react/" target="_blank" class="btn btn-primary btn-md">Free download
                <i class="fas fa-download ml-2"></i>
              </a>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card image-->
            <div class="view overlay">
              <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-vue.jpg" class="card-img-top" alt="">
              <a href="https://mdbootstrap.com/vue/" target="_blank">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">
              <!--Title-->
              <h4 class="card-title">MDB with Vue</h4>
              <!--Text-->
              <p class="card-text">Based on the latest Bootstrap 4 and Vue 2.5.7. </p>
              <a href="https://mdbootstrap.com/vue/" target="_blank" class="btn btn-primary btn-md">Free download
                <i class="fas fa-download ml-2"></i>
              </a>
            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Pagination-->
      <nav class="d-flex justify-content-center wow fadeIn">
        <ul class="pagination pg-blue">

          <!--Arrow left-->
          <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>

          <li class="page-item active">
            <a class="page-link" href="#">1
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">5</a>
          </li>

          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
      <!--Pagination-->

    </section>
    <!--Section: Cards-->

  </div>
@endsection
