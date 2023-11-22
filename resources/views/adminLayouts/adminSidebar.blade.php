<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item @if(request()->segment(3) == 'dashboard') menu-item-active  @endif"
                aria-haspopup="true">
                <a href="{{route('dashboard')}}" class="menu-link">
                    <i class="menu-icon flaticon-home">
                        <span></span>
                    </i>
                    <span class="menu-text">{{__('lang.home')}}</span>
                </a>
            </li>
            @can('read-customer')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'customers' &&  (request()->segment(4) !='black-list' ||  request()->segment(4) !='late-list')) menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('customers.index')}}" class="menu-link menu-toggle">
                        <i class="menu-icon  flaticon-users-1"></i>
                        <span class="menu-text">{{__('lang.customers')}}</span>
                    </a>
                </li>
            @endcan

            @can('read-customer-black-list')
                <li class="menu-item menu-item-submenu @if(  request()->segment(4) == 'black-list' ) menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('customers.black-list')}}" class="menu-link menu-toggle">
                        <i class="menu-icon  flaticon2-cancel"></i>
                        <span class="menu-text">{{__('lang.black_list_customers')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-customer-late')
                <li class="menu-item menu-item-submenu @if(  request()->segment(4) == 'late-list' ) menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('customers.late-list')}}" class="menu-link menu-toggle">
                        <i class="menu-icon  flaticon2-warning"></i>
                        <span class="menu-text">{{__('lang.late_list_customers')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-installment_request')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'installment_requests') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('installment_requests.index')}}" class="menu-link menu-toggle">
                        <i class="menu-icon  flaticon2-sheet"></i>
                        <span class="menu-text">{{__('lang.installment_requests')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-invoice')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'invoices') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('invoices.index')}}" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon2-files-and-folders"></i>
                        <span class="menu-text">{{__('lang.invoices')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-invoice-execution')
            <li class="menu-item menu-item-submenu @if(request()->routeIs('invoices.execution.get')) menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('invoices.execution.get')}}" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon2-files-and-folders"></i>
                    <span class="menu-text">الفواتير المعدومة</span>
                </a>
            </li>
            @endcan
            @can('read-lawsuit')
                <li class="menu-item menu-item-submenu @if(request()->routeIs()  == 'lawsuits.*') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('lawsuits.index')}}" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-bell"></i>
                        <span class="menu-text">{{__('lang.lawsuits')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-invoice-summary')
            <li class="menu-item menu-item-submenu @if(request()->routeIs() == 'summary.*') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('summary.index')}}" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-bell"></i>
                    <span class="menu-text">{{__('lang.summary')}}</span>
                </a>
            </li>
            @endcan
            @can('read-admins')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'admins') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('admins')}}" class="menu-link menu-toggle">
                        <i class="menu-icon  flaticon2-user-1"></i>
                        <span class="menu-text">{{__('lang.admins')}}</span>
                    </a>
                </li>
            @endcan
            @can('read-roles')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'roles') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('roles')}}" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon2-notepad"></i>
                        <span class="menu-text">{{__('lang.roles')}}</span>
                    </a>
                </li>
            @endcan

            @can('read-settings')
                <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'settings') menu-item-open @endif "
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{route('settings')}}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-cog"></i>
                        <span class="menu-text">{{__('lang.settings')}}</span>
                    </a>
                </li>
            @endcan
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

                </div>
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::Notifications-->
                <div class="dropdown">
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        @php $total_new = \App\Models\Notification::not_seen()->orderBy('id','desc')->count() ; @endphp
                        @if($total_new > 0)
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-danger">
                                        <span
                                            style="color: red;font-weight: bold;font-size: 18px;">{{$total_new}}</span>
                                <span class="svg-icon svg-icon-xl svg-icon-danger">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Notifications1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path
            d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
            fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
    </g>
</svg><!--end::Svg Icon-->
                                    <!--end::Svg Icon-->
                                        </span>
                                <span class="pulse-ring"></span>
                            </div>
                        @else
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                             <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Notifications1.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path
            d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
            fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
    </g>
</svg><!--end::Svg Icon-->
                                            <!--end::Svg Icon-->
                                        </span>
                                <span class="pulse-ring"></span>
                            </div>
                        @endif
                    </div>
                    <div
                        class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <form>
                            <!--begin::Header-->
                            <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                 style="background-image: url(/assets/media/misc/bg-1.jpg)">
                                <!--begin::Title-->
                                <h4 class="d-flex flex-center rounded-top">
                                                    <span
                                                        class="text-white">الاشعارات</span>

                                    <span
                                        class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{$total_new}} جديد </span>
                                </h4>
                                <!--end::Title-->
                                <!--begin::Tabs-->
                                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-toggle="tab"
                                           href="#topbar_notifications_events">الاشعارات</a>
                                    </li>


                                </ul>
                                <!--end::Tabs-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Content-->
                            <div class="tab-content">
                                <!--begin::Tabpane-->

                                <div class="tab-pane active" id="topbar_notifications_events" role="tabpanel">
                                    <!--begin::Nav-->
                                    <div class="navi navi-hover scroll my-4 ps ps--active-y" data-scroll="true"
                                         data-height="300" data-mobile-height="200"
                                         style="height: 300px; overflow: hidden;">
                                    @foreach(\App\Models\Notification::not_seen()->orderBy('id','desc')->get() as $row)
                                        <!--begin::Item-->
                                            <a href="{{route($row->route,$row->target_id)}}" class="navi-item">
                                                <div class="navi-link">
                                                    <div class="navi-icon mr-2">
                                                        <i class="flaticon2-paper-plane text-danger"></i>
                                                    </div>
                                                    <div class="navi-text">
                                                        <div class="font-weight-bold">{{$row->title}}</div>
                                                        <div class="text-muted">{{$row->message}}</div>
                                                        <div
                                                            class="text-muted">{{$row->created_at->translatedFormat('Y-m-d g:i a')}}</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!--end::Item-->
                                        @endforeach
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0"
                                                 style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 0px; height: 300px;">
                                            <div class="ps__thumb-y" tabindex="0"
                                                 style="top: 0px; height: 107px;"></div>
                                        </div>
                                    </div>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Tabpane-->
                            </div>
                            <!--end::Content-->
                        </form>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--begin::Languages-->
            {{--                <div class="dropdown">--}}
            {{--                    <!--begin::Toggle-->--}}
            {{--                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
            {{--                        <span style="cursor: pointer;"--}}
            {{--                              class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{__('lang.language')}}</span>--}}
            {{--                    </div>--}}
            {{--                    <!--end::Toggle-->--}}
            {{--                    <!--begin::Dropdown-->--}}
            {{--                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">--}}
            {{--                        <!--begin::Nav-->--}}
            {{--                        <ul class="navi navi-hover py-4">--}}
            {{--                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
            {{--                                <li class="navi-item ">--}}
            {{--                                    <a class="navi-link" hreflang="{{ $localeCode }}"--}}
            {{--                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}


            {{--                                        {{ $properties['native'] }}--}}
            {{--                                        &nbsp;--}}
            {{--                                        @if($properties['native'] == 'العربية')--}}
            {{--                                            <span class="symbol symbol-20   ">--}}
            {{--														<img--}}
            {{--                                                            src="{{asset('/')}}assets/media/svg/flags/133-saudi-arabia.svg"--}}
            {{--                                                            alt="">--}}
            {{--													</span>--}}
            {{--                                        @else()--}}
            {{--                                            <span class="symbol symbol-20  ">--}}
            {{--														<img--}}
            {{--                                                            src="{{asset('/')}}assets/media/svg/flags/226-united-states.svg"--}}
            {{--                                                            alt="">--}}
            {{--													</span>--}}
            {{--                                        @endif--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            @endforeach--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            <!--end::Languages-->
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                         id="kt_quick_user_toggle">
                        <span
                            class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{auth()->user()->name}}</span>
                        <span class="symbol symbol-lg-35 symbol-25">
											<span class="symbol-label font-size-h5 font-weight-bold">
                                                <img style="width: 35px;"
                                                     src="{{url('/').'/defaults/user_default.png'}}">
                                            </span>
										</span>
                    </div>
                </div>
                <!--end::User-->

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                @yield('breadcrumb')
                <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->


        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
