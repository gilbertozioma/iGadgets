<div>
    {{-- Footer Area --}}
    <div class="footer-area">
        <div class="container">
            <div class="row">
                {{-- Website Description --}}
                <div class="col-md-3">
                    <h4 class="footer-heading">{{ $appSetting->website_name ?? 'website name' }}</h4>
                    <div class="footer-underline"></div>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                {{-- Quick Links --}}
                <div class="col-md-3">
                    <h4 class="footer-heading">Quick Links</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ url('/') }}" class="text-white">Home</a></div>
                    <div class="mb-2"><a href="{{ url('/about-us') }}" class="text-white">About Us</a></div>
                    <div class="mb-2"><a href="{{ url('/contact-us') }}" class="text-white">Contact Us</a></div>
                    <div class="mb-2"><a href="{{ url('/blogs') }}" class="text-white">Blogs</a></div>
                    <div class="mb-2"><a href="#" class="text-white">Sitemaps</a></div>
                </div>
                {{-- Shop Now Links --}}
                <div class="col-md-3">
                    <h4 class="footer-heading">Shop Now</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ url('/collections') }}" class="text-white">Collections</a></div>
                    <div class="mb-2"><a href="{{ url('/') }}" class="text-white">Trending Products</a></div>
                    <div class="mb-2"><a href="{{ url('/new-arrivals') }}" class="text-white">New Arrivals Products</a></div>
                    <div class="mb-2"><a href="{{ url('/featured-products') }}" class="text-white">Featured Products</a></div>
                    <div class="mb-2"><a href="{{ url('/cart') }}" class="text-white">Cart</a></div>
                </div>
                {{-- Contact Information --}}
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i> 
                            {{ $appSetting->address ?? 'address' }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-phone"></i>  {{ $appSetting->phone1 ?? 'phone 1' }}
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-envelope"></i> {{ $appSetting->email1 ?? 'email 1' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Copyright --}}
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                {{-- Copyright Text --}}
                <div class="col-md-8">
                    <p class=""> &copy; {{ date('Y') }} - {{ $appSetting->website_name ?? 'website name' }}. All rights reserved.</p>
                </div>
                {{-- Social Media Links --}}
                <div class="col-md-4">
                    <div class="social-media text-white">
                        Get Connected:
                        @if($appSetting->facebook)
                            <a href="http://facebook.com/gilbertozioma7" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        @endif
                        @if($appSetting->twitter)
                            <a href="http://twitter.com/goodnews_001" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        @endif
                        @if($appSetting->instagram)
                            <a href="http://instagram.com/good4everr" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if($appSetting->youtube)
                            <a href="/{{ $appSetting->youtube }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
