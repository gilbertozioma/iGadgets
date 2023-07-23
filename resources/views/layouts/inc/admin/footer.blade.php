{{-- Copyright --}}
<div class="copyright-area" style="background-color: #7617b6">
    <div class="container">
        <div class="row">
            {{-- Copyright Text --}}
            <div class="col-md-8">
                <p class="">&copy; {{ date('Y') }} {{ $appSetting->website_name ?? 'website name' }}. All rights reserved.</p>
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
