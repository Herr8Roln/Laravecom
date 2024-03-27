<div class="container">
    <div class="row">

        <!-- Sidebar with categories -->
        <div class="col-md-3">
            <div class="sidebar d-flex flex-column h-100">
                <h2 class="mb-4">Categories</h2>
                <ul class="list-unstyled mb-auto">
                    @foreach($categories as $category)
                    <li class="mb-3">
                    <a href="{{ route('filter.products', ['category_id' => $category->id]) }}" style="text-decoration: none; color: black;">
                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="mr-2" style="max-width: 20px;">
                    {{ $category->name }}
                    </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <h
        <div class="col-md-9 border-left">
            <!-- Slider section -->
            <section class="slider_section">
                <div class="slider_bg_box">
                    <img src="/home/images/slider-bg.jpg" alt="">
                </div>
                <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Slider items -->
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6">
                                        <div class="detail-box">
                                            <h1>
                                                <span>Sale 20% Off</span>
                                                <br>
                                                On Everything
                                            </h1>
                                            <p>Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.</p>
                                            <div class="btn-box">
                                                <a href="" class="btn1">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Additional slider items -->
                    </div>
                    <!-- Additional carousel settings -->
                </div>
            </section>
            <!-- End slider section -->
        </div>
    </div>
</div>
