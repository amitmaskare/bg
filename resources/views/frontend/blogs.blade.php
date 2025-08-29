@extends('layout.app')
@section('content')
        <div class="breadcrumb-section">
            <div class="container">
                <h2>Blog</h2>
                <nav class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
       
    </div>

    <!-- section start -->
    <section class="blog-page section-b-space ratio2_3">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8 col-xxl-9 order-lg-2">
                    <div class="sticky-details">
                        <div class="row g-4">
                           @foreach($blogs as $blog)
                                <div class="col-sm-6 col-xxl-4">
                                    <div class="blog-box sticky-blog-box">
                                        <div class="blog-image">
                                            <div class="blog-label-tag"><i class="ri-pushpin-fill"></i></div>
                                            <a href="{{ route('blogs_detail', $blog->blog_id) }}">
                                                <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="{{ $blog->title }}">
                                            </a>
                                        </div>
                                        <div class="blog-contain">
                                            <a href="blog-details.html">
                                                <h3>{{ $blog->title }}</h3>
                                            </a>
                                            <div class="blog-label">
                                                <span class="time">
                                                    <i class="ri-time-line"></i>
                                                    <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</span>
                                                </span>
                                                <span class="super">
                                                    <i class="ri-user-line"></i>
                                                    <span>admin</span>
                                                </span>
                                            </div>
                                            <p>{!! $blog->description !!}</p>
                                        <a class="blog-button" href="{{ route('blogs_detail', $blog->blog_id) }}">
                                            Read More <i class="ri-arrow-right-line"></i>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                         
                        </div>
                        <div class="product-pagination">
                            <div class="theme-paggination-block">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#!" aria-label="Previous">
                                                <span>
                                                    <i class="ri-arrow-left-s-line"></i>
                                                </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#!">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#!">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#!">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#!" aria-label="Next">
                                                <span>
                                                    <i class="ri-arrow-right-s-line"></i>
                                                </span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="blog-sidebar">
                        <div class="theme-card">
                            <h4>Recent Blog</h4>
                            <ul class="recent-blog">
                                   @foreach($blogs as $blog)
                                <li>
                                    <div class="media blog-box">
                                        <div class="blog-image"><img class="img-fluid lazyload"
                                                src="{{ asset('uploads/blogs/'.$blog->image) }}"
                                                alt="Elevate Your Space: The Art of Stylish Furnishing!"></div>
                                        <div class="media-body blog-content">
                                            <h6>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y h:i') }}</h6><a href="{{ route('blogs_detail', $blog->blog_id) }}">
                                                <h5 class="recent-name">{{ $blog->title }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                  @endforeach
                              
                            </ul>
                        </div>
                        <div class="theme-card">
                            <h4>Categories</h4>
                            <ul class="categories">
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Bags</h5><span>(3)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Books</h5><span>(6)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Christmas</h5><span>(2)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Cosmetics</h5><span>(5)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Farm Fresh Produce</h5><span>(3)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Fashion</h5><span>(7)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Flowers</h5><span>(3)</span>
                                    </a></li>
                                <li><a class="category-name" href="category-page.html">
                                        <h5>Footwear</h5><span>(8)</span>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="theme-card">
                            <h4>Tags</h4>
                            <ul class="tags">
                                <li><a href="#!">Christmas</a></li>
                                <li><a href="#!">Bags</a></li>
                                <li><a href="#!">Marijuana</a></li>
                                <li><a href="#!">Jewellery</a></li>
                                <li><a href="#!">Gym</a></li>
                                <li><a href="#!">Flowers</a></li>
                                <li><a href="#!">Pets</a></li>
                                <li><a href="#!">Cosmetics</a></li>
                                <li><a href="#!">Furnishing</a></li>
                                <li><a href="#!">Fashion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->

@endsection