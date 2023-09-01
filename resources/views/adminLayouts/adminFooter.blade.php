</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">

            {{--            <span class="text-muted font-weight-bold mr-2">{{\Carbon\Carbon::now()->year}}</span>--}}
            <a title="{{$globalSetting['copyright']}}" target="_blank"
               class="text-dark-75 text-hover-primary">{{$globalSetting['copyright']}}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-success" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">

            <div class="d-flex flex-column">
                <a class="font-weight-bold font-size-h5 text-dark-75 text-hover-success">{{auth()->user()->name}}</a>
                <div class="navi mt-2">
                    <a class="navi-item">

                        <span class="navi-text text-muted text-hover-success">{{auth()->user()->email}}</span>
                        </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm btn-light-success font-weight-bolder py-2 px-5">{{trans('lang.logout')}}</button>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="{{route('update_profile')}}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                    fill="#000000"/>
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">@lang('lang.update_profile')</div>
                    </div>
                </div>
            </a>
            <!--end:Item-->
        </div>
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"/>
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
						<path
                            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                            fill="#000000" fill-rule="nonzero"/>
					</g>
				</svg>
                <!--end::Svg Icon-->
			</span>
</div>
<audio id="myAudio">
    <source  src="{{asset('notification.mp3')}}" type="audio/mp3">
   </audio>
<button id="myAudioButton" onclick="sound()" style="z-index: -99999999; background: transparent;
    border: none;" ></button>

<!--end::Scrolltop-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('/')}}assets/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('/')}}assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="{{asset('/')}}assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('/')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="{{asset('/')}}assets/plugins/custom/gmaps/gmaps.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('/')}}assets/js/pages/widgets.js"></script>
<!--begin::Page Scripts(used by this page)-->

<script src="{{asset('/')}}assets/js/pages/crud/file-upload/uppy.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@include('sweetalert::alert')
@include('sweetalert::alert', ['cdn' => "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css"])


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>


<script>

    const button = $('#myAudioButton');

    function sound(){
        let x = document.getElementById("myAudio");
        x.play();
    }

    // Enable pusher logging - don't include this in production

    Pusher.logToConsole = false;

    var pusher = new Pusher('79402e7ec57b73114402', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('test');

    channel.bind('notification-send', function (data) {
        toastr.options.onclick = function(e) {window.location.href=this.data.data.url }
        toastr.info(data.data.message, "Title", {
            "data": data
        });

        button.trigger('click')

    });
</script>

<script>

    $(document).ready(function () {

        $(document).on('submit', 'form', function () {
            $('button').attr('disabled', 'disabled');
        });
    });
</script>
@stack('scripts')

<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
