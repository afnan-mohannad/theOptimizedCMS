@extends('backend.app')

@section('title',__('admin.Roles'))

@section('li1',__('admin.Listing'))
@section('li1_link',route('app.roles.index'))
@section('li2','')
@section('li2_link','')

@push('css')
@if (lang() == "en")
<link href="{{asset('assets/backend/metronic/ltr/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@else
<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/rtl/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css" />
@endif
@endpush

@section('content')
<!--begin::Content-->
@if(Request::route()->getName() == "app.roles.create")
    @livewire('admin.roles.role-create')
@elseif(Request::route()->getName() == "app.roles.edit")
    @livewire('admin.roles.role-update',['id'=>Request::route()->id])
@else
@livewire('admin.roles.role-data')
@endif

@livewire('admin.roles.role-delete',,key(Str::random(8)))
<!--end::Content-->
@endsection

@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/roles.js" defer></script>

<script>
    $("#kt_subscriptions_table").DataTable();
</script>
<script type="text/javascript">
    // Listen for click on toggle checkbox
    $('#select-all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });
</script>
@endpush
