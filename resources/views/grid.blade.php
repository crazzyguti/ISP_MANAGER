@extends('layouts.app')
@section('content')

<!--Section: Blog v.2-->
<section class="section extra-margins text-center">

    <!--Section heading-->
    <h1 class="section-heading">Section title</h1>
    <!--Section sescription-->
    <p class="section-description">
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
        anim id est laborum.
    </p>
    <!--First row-->
    <div class="row">

        <!--First column-->
        <div class="col-lg-4 col-md-12 mb-r">
            <!--Featured image-->
            <div class="view overlay hm-white-slight mb-2">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(75).jpg"
                    alt="First sample image">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>

            <!--Excerpt-->
            <a href="" class="cyan-text">
                <h5><i class="fa fa-map "></i>Adventure</h5>
            </a>
            <h4>How to organize an expedition to Mount Everest?</h4>
            <p>by <a><strong>Billy Forester</strong></a>, 15/07/2016</p>
            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime
                placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis
                aut rerum.</p>
            <a class="btn btn-mdb">Read more</a>
        </div>
        <!--/First column-->

        <!--Second column-->
        <div class="col-lg-4 col-md-6 mb-r">
            <!--Featured image-->
            <div class="view overlay hm-white-slight mb-2">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(84).jpg"
                    alt="Second sample image">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>

            <!--Excerpt-->
            <a href="" class="purple-text">
                <h5><i class="fa fa-graduation-cap"></i>Education</h5>
            </a>
            <h4>Gain work experience while traveling.</h4>
            <p>by <a><strong>Billy Forester</strong></a>, 12/07/2016</p>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti
                atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident et
                dolorum fuga.</p>
            <a class="btn btn-mdb">Read more</a>
        </div>
        <!--/Second column-->

        <!--Third column-->
        <div class="col-lg-4 col-md-6 mb-r">
            <!--Featured image-->
            <div class="view overlay hm-white-slight mb-2">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(33).jpg"
                    alt="Thrid sample image">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>

            <!--Excerpt-->
            <a href="" class="orange-text">
                <h5><i class="fa fa-fire "></i>Culture</h5>
            </a>
            <h4>Italia - the people, customs and delicious food.</h4>
            <p>by <a><strong>Billy Forester</strong></a>, 10/07/2016</p>
            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
                dolores eos qui ratione voluptatem sequi nesciunt. Neque porro qui dolorem ipsum quia sit amet,
                consectetur.</p>
            <a class="btn btn-mdb">Read more</a>
        </div>
        <!--/Third column-->

    </div>
    <!--/First row-->

</section>
<!--/Section: Blog v.2-->
@endsection
