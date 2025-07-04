<div>
    <button type="button" class="btn btn-success" wire:click="export">
        <i class="bi bi-file-earmark-arrow-down-fill"></i>
        {{__('admin.export_all')}}
    </button>


    @if($exporting && !$exportFinished)
        <div class="d-inline" wire:poll="updateExportProgress">{{__('admin.export_wait')}}</div>
    @endif

    @if($exportFinished)
        {{__('admin.done')}} <a class="stretched-link" wire:click="downloadExport">{{__('admin.here')}}</a>
    @endif
</div>
