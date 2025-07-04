<div>
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('admin.Search')}}" wire:model.live='search'/>
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                @if ($checked)
                    <button type="button" class="btn btn-danger me-1" onclick="confirm('Are you sure you want to delete these Records?') || event.stopImmediatePropagation()"
                    wire:click="deleteRecords()">
                    <i class="bi bi-trash3-fill"></i>
                    {{__('admin.Delete Selected')}} 
                        ({{ count($checked) }})
                    </button>
                    <button type="button" class="btn btn-info me-1" onclick="confirm('Are you sure you want to export these Records?') || event.stopImmediatePropagation()"
                    wire:click="exportSelected()">
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    {{__('admin.Export Selected')}} 
                        ({{ count($checked) }})
                    </button>
                    @livewire('admin.tables.users-export')
                @else 
                    @livewire('admin.tables.users-import')
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary bg-color mx-2" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('admin.users.Add User')}}
                    </button>
                    <!--end::Add user-->
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('admin.Filter')}}
                    </button>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">{{__('admin.Filter Options')}}</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Separator-->
                        <!--begin::Content-->
                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">
                                    {{__('admin.users.Joined At')}}:
                                </label>
                                <input class="form-control form-control-solid" placeholder="{{__('admin.users.Joined At')}}" id="kt_datepicker_1" wire:model.change="publish_date"/>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">{{__('admin.Status')}}:</label>
                                <select wire:model.change="status" class="form-select form-select-solid fw-bold status" data-placeholder="{{__('admin.Select an option')}}" data-allow-clear="true" id="status">
                                    <option value="">{{__('admin.Select an option')}}</option>
                                    <option value="active">{{__('admin.Active')}}</option>
                                    <option value="in_active">{{__('admin.InActive')}}</option>
                                </select> 
                            </div>
                            <!--end::Input group-->
                            <!--end::Input group-->
                            @if(isset($roles) && !empty($roles))
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">
                                    {{__('admin.users.User Roles')}}:
                                </label>
                                <select class="form-select form-select-solid fw-bold" data-placeholder="{{__('admin.Select option')}}" wire:model.change="role_id">
                                    <option>{{__('admin.Select option')}}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->
                            @endif
                            <!--begin::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="reset" href="{{route('app.users.index')}}">{{__('admin.Reset')}}</a>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div> 
                    <!--end::Menu 1-->
                    <!--end::Filter-->
                @endif
            </div>
            <!--end::Toolbar-->
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_arader">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">{{__('admin.users.Add User')}}</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        @livewire('admin.users.users-create', ['data'=>$data], key(Str::random(10)))
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add task-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        @if(isset($data) && !empty($data) && count($data) >0)
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <!--begin::Table head-->
                <thead>
                    {{-- @if ($selectPage)
                    <caption>
                        @if ($selectAll)
                        <div>
                        {{__('admin.You have selected all')}} <strong>{{ $data->total() }}</strong> {{__('admin.items')}}
                        </div>
                        @else
                        <div>
                            {{__('admin.You have selected')}} <strong>{{ count($checked) }}</strong>{{__('admin.items, Do you want to Select All')}}
                            <strong>{{ $data->total() }}</strong>?
                            <a href="#" class="ml-2" wire:click="selectAll">{{__('admin.Select All')}}</a>
                        </div>
                        @endif
                    </caption>
                    @endif --}}
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2" id="th">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input checkAll" type="checkbox" wire:model.change="selectPage" onclick="allSelected()"/>
                            </div>
                        </th> 
                        <th wire:click="sort('name')" class="min-w-125px" id="th">
                            <i class="bi bi-arrow-down-up"></i> 
                            {{__('admin.Name')}}
                        </th>
                        <th wire:click="sort('email')" class="min-w-125px" id="th">
                            <i class="bi bi-arrow-down-up"></i>
                            {{__('admin.users.Email')}}
                        </th>
                        <th wire:click="sort('role')" class="min-w-125px" id="th">
                            <i class="bi bi-arrow-down-up"></i>
                            {{__('admin.Role')}}
                        </th>
                        <th wire:click="sort('created_at')" class="min-w-125px" id="th">
                            <i class="bi bi-arrow-down-up"></i>
                            {{__('admin.Created At')}}
                        </th>
                        <th wire:click="sort('status')" class="min-w-125px" id="th">
                            <i class="bi bi-arrow-down-up"></i>
                            {{__('admin.Status')}}
                        </th>
                        <th class="min-w-125px" id="th"></th>
                        <th class="text-end min-w-100px" id="th">{{__('admin.Actions')}}</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                    @foreach ($data as $key=>$user)
                        <!--begin::Table row-->
                        <tr class="@if ($this->isChecked($user->id))
                            table-primary
                        @endif">
                            <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid checkbox-delete">
                                    <input class="form-check-input group-checked" type="checkbox" value="{{$user->id}}" wire:model.change="checked" />
                                </div>
                            </td>
                            <!--end::Checkbox-->
                            <!--begin::User=-->
                            <td class="align-items-center">
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <div class="symbol-label">
                                        @if(isset($user->avatar) && !empty($user->avatar))
                                        <img src="{{getImage($user->avatar,null,50,50)}}" alt="{{$user->name}}" class="w-100" />
                                        @else
                                        <img src="{{asset('assets/backend/images/avatars/blank.png')}}" alt="{{$user->name}}" class="w-100" />
                                        @endif
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <span>{{Str::limit($user->name,10)}}</span>
                                </div>
                                <!--begin::User details-->
                            </td>
                            <!--end::User=-->
                            <td>{{Str::limit($user->email,20)}}</td>
                            <!--begin::Role=-->
                            <td>{{Str::limit($user->role->name,10)}}</td>
                            <!--end::Role=-->
                            <!--begin::Joined-->
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <!--begin::Joined-->
                            <!--begin::Two step=-->
                            <td>
                                @if ($user->status)
                                    <div class="badge badge-light-success">{{__('admin.Active')}}</div>
                                @else
                                    <div class="badge badge-light-danger">{{__('admin.InActive')}}</div>
                                @endif
                            </td>
                            <!--end::Two step=-->
                            <!--begin::Two step=-->
                            <td>
                                <div>
                                    <livewire:admin.tables.toggle-button
                                        :model="$user"
                                        field="status"
                                        key="{{ Str::random(10) }}" />
                                </div>
                            </td>
                            <!--end::Two step=-->
                            <!--begin::Action=-->
                            <td class="text-end actions">
                                <a class="btn btn-light btn-active-light-primary btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" id="actions_{{$key+1}}" wire:ignore>{{__('admin.Actions')}}
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" wire:click.prevent="$dispatch('userShow', { id: {{ $user->id }} })" class="menu-link px-3">{{__('admin.View')}}</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" wire:click.prevent="$dispatch('userUpdate', { id: {{ $user->id }} })" class="menu-link px-3">{{__('admin.Edit')}}</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" wire:click.prevent="$dispatch('userDelete', { id: {{ $user->id }} })" class="menu-link px-3" data-kt-users-table-filter="delete_row">{{__('admin.Delete')}}</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                            <!--end::Action=-->
                        </tr>
                        <!--end::Table row-->
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
            {{ $data->links() }}
            <div class="d-flex">
                <div class="d-flex align-items-center ml-4">
                    <label for="paginate" class="text-nowrap mr-2 mb-0">{{__('admin.Per Page')}} </label>
                    <select wire:model.change="paginate" name="paginate" id="paginate" class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
        @else
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
        @endif
    </div>
    <!--end::Card body-->
</div>
