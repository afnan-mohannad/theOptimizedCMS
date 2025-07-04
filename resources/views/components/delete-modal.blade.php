<div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">
                        {{__('admin.confirm_delete_text')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{__('admin.Close')}}
                        </button>
                        <button type="submit" class="btn btn-primary bg-color">{{__('admin.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>