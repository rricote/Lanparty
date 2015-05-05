@extends('web.sidebar')

@section('side')
<!-- CONTENT BODY - START -->
<div class="col-sm-8">

    <div class="box colored tournament-partner">
        <div class="row">
            <div class="col-xs-4"><a href=""><img src="{{ asset('images/partner_1.png')}}" class="img-responsive center-block" alt=""></a></div>
            <div class="col-xs-4"><a href=""><img src="{{ asset('images/partner_2.png')}}" class="img-responsive center-block" alt=""></a></div>
            <div class="col-xs-4"><a href=""><img src="{{ asset('images/partner_3.png')}}" class="img-responsive center-block" alt=""></a></div>
            <div class="col-xs-4"><a href=""><img src="{{ asset('images/partner_2.png')}}" class="img-responsive center-block" alt=""></a></div>
            <div class="col-xs-4"><a href=""><img src="{{ asset('images/partner_1.png')}}" class="img-responsive center-block" alt=""></a></div>
        </div>
    </div>

    <div class="box">

        <!-- POST - START -->
        <article class="post">
            <div class="post-date-wrapper">
                <div class="post-date">
                    <div class="day">25</div>
                    <div class="month">Jan 2014</div>
                </div>
                <div class="post-type">
                    <i class="fa fa-video-camera"></i>
                </div>
            </div>
            <div class="post-body">
                <h2>Blog post with Vimeo video</h2>
                <p><img src="{{ asset('images/image_005.jpg')}}" class="img-responsive" alt="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</p>
                <div class="post-info">
                    <span>Posted by: admin</span>
                    <a href="single.html" class="btn btn-inverse">View More</a>
                </div>
            </div>
        </article>
        <!-- POST - END -->

        <!-- POST - START -->
        <article class="post">
            <div class="post-date-wrapper">
                <div class="post-date">
                    <div class="day">25</div>
                    <div class="month">Jan 2014</div>
                </div>
                <div class="post-type">
                    <i class="fa fa-font"></i>
                </div>
            </div>
            <div class="post-body">
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et.</h2>
                <div class="flex-video widescreen"><iframe src="https://player.vimeo.com/video/48443133"></iframe></div><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</p>
                <div class="post-info">
                    <span>Posted by: admin</span>
                    <a href="single.html" class="btn btn-inverse">View More</a>
                </div>
            </div>
        </article>
        <!-- POST - END -->

        <!-- POST - START -->
        <article class="post gallery-post">
            <div class="post-date-wrapper">
                <div class="post-date">
                    <div class="day">25</div>
                    <div class="month">Jan 2014</div>
                </div>
                <div class="post-type">
                    <i class="fa fa-soundcloud"></i>
                </div>
            </div>
            <div class="post-body">
                <h2>Blog post with Gallery Carousel</h2>
                <div class="owl-carousel owl-theme">
                    <div class="item"><img src="{{ asset('images/image_001.jpg')}}" class="img-responsive" alt=""></div>
                    <div class="item"><img src="{{ asset('images/image_002.jpg')}}" class="img-responsive" alt=""></div>
                    <div class="item"><img src="{{ asset('images/image_003.jpg')}}" class="img-responsive" alt=""></div>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</p>
                <div class="post-info">
                    <span>Posted by: admin</span>
                    <a href="single.html" class="btn btn-inverse">View More</a>
                </div>
            </div>
        </article>
        <!-- POST - END -->

        <!-- POST - START -->
        <article class="post">
            <div class="post-date-wrapper">
                <div class="post-date">
                    <div class="day">25</div>
                    <div class="month">Jan 2014</div>
                </div>
                <div class="post-type">
                    <i class="fa fa-photo"></i>
                </div>
            </div>
            <div class="post-body">
                <h2>Blog post with Soundcloud</h2>
                <div class="flex-video soundcloud">
                    <iframe height="166" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/122756510&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</p>
                <div class="post-info">
                    <span>Posted by: admin</span>
                    <a href="single.html" class="btn btn-inverse">View More</a>
                </div>
            </div>
        </article>
        <!-- POST - END -->

        <!-- POST - START -->
        <article class="post">
            <div class="post-date-wrapper">
                <div class="post-date">
                    <div class="day">25</div>
                    <div class="month">Jan 2014</div>
                </div>
                <div class="post-type">
                    <i class="fa fa-font"></i>
                </div>
            </div>
            <div class="post-body">
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et.</h2>
                <div class="flex-video widescreen"><iframe width="1280" height="720" src="https://www.youtube.com/embed/ZgYWkbMRhz8?rel=0" allowfullscreen></iframe></div><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapiis urna.</p>
                <div class="post-info">
                    <span>Posted by: admin</span>
                    <a href="single.html" class="btn btn-inverse">View More</a>
                </div>
            </div>
        </article>
        <!-- POST - END -->

    </div>

    <ul class="pagination">
        <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>

</div>
<!-- CONTENT BODY - END -->
@endsection