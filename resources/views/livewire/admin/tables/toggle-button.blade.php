<div>
    <div class="form-check form-switch form-check-custom form-check-solid me-10">
        <input class="form-check-input h-20px w-30px"
                type="checkbox" 
                name="toggle"
                id="toggle"
                wire:model.lazy="is_active"
                role="switch" 
                @if($is_active) checked @endif
                />
    </div>
</div>