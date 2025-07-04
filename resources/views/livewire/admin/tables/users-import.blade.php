<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <input type="file" wire:model="importFile" class="@error('importFile') is-invalid @enderror" accept=".csv">
        <button class="btn btn-secondary">
            <i class="bi bi-file-earmark-arrow-up-fill"></i>
            {{__('admin.import')}}
        </button>
        @error('importFile')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </form>

    @if($importing && !$importFinished)
        <div wire:poll="updateImportProgress">{{__('admin.importing')}}</div>
    @endif

    @if($importFinished)
        {{__('admin.importing_finished')}}
    @endif
</div>
