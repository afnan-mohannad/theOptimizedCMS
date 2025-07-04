<div class="row draggable-zone">
    <ol class="dd-list">
        @forelse($menuItems as $item)
            <li class="dd-item" data-id="{{ $item->id }}">
                <div class="dd-handle">
                    @if ($item->type == 'divider')
                    <strong>Divider: {{ $item->divider_title[lang()] }}</strong>
                    @else
                        <span>{{ $item->title[lang()] }}</span> <small class="url">{{ $item->url }}</small>
                    @endif
                </div>
                <div class="pull-right item_actions">
                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" onclick="deleteData({{ $item->id }})">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('app.menus.item.destroy',['id'=>$item->menu->id,'itemId'=>$item->id]) }}"
                        method="POST" style="display: none;">
                        @csrf()
                        @method('DELETE')
                    </form>
                    @if ($item->type != 'divider')
                    <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="{{ route('app.menus.item.edit',['id'=>$item->menu->id,'itemId'=>$item->id]) }}">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    @endif
                </div>
                @if(!$item->childs->isEmpty())
                    <x-menu-builder :menuItems="$item->childs"/>
                @endif
            </li>
        @empty
            <!--begin::Empty-->
            <div data-kt-search-element="empty" class="text-center">
                <!--begin::Icon-->
                <div class="pt-10 pb-10">
                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                    <span class="svg-icon svg-icon-4x opacity-50">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor" />
                            <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor" />
                            <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="currentColor" />
                            <path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Icon-->
                <!--begin::Message-->
                <div class="pb-15 fw-semibold">
                    <h3 class="text-gray-600 fs-5 mb-2">{{__('admin.No Result Found.')}}</h3>
                </div>
                <!--end::Message-->
            </div>
            <!--end::Empty-->
        @endforelse
    </ol>
</div>
