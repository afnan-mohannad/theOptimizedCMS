<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_arader, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="kt_aside_menu" data-kt-menu="true">
            @foreach($items as $item)
                @if ($item->type == 'divider')
                    @if (auth()->user()->role->slug =='author' && $item->divider_title[lang()] =='Access Control')
                   
                    @else
                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">{{ $item->divider_title[lang()] }}</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    @endif
                @else
                    @can($item->permission->slug)
                        @if($item->childs->isEmpty())
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ Request::is(ltrim($item->url,'/').'*') ? 'active' : '' }}" href="{{ $item->url }}" target="{{$item->target}}">
                                    <span class="menu-icon">
                                        <i class="{{ $item->icon_class }}"></i>
                                    </span>
                                    <span class="menu-title"> {{ $item->title[lang()] }} </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        @else
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (request()->get('category') !== null) show @endif">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="{{$item->icon_class}}"></span>
                                    </span>
                                    <span class="menu-title">{{ $item->title[lang()] }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    @foreach ($item->childs as $key=>$child)
                                        <!--begin:Menu item-->
                                        <div class="menu-item  @foreach($item->childs as $inner_child)
                                            @if (Request::is(ltrim($inner_child->url,'/').'*'))
                                                active
                                                @break
                                            @endif
                                        @endforeach">
                                            <!--begin:Menu link-->
                                            <a class="menu-link @if (ucfirst(request()->get('category')) == $child->title[lang()]) active @endif" href="{{ $child->url }}" target="{{$item->target}}">
                                                <span class="menu-bullet">
                                                    <span class="{{$child->icon_class}}"></span>
                                                </span>
                                                <span class="menu-title">{{ $child->title[lang()] }}</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    @endforeach
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        @endif
                    @endcan
                @endif
            @endforeach
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside menu-->
