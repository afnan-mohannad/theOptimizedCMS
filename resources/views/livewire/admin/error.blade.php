@error($property)
    @if($message == "The picture failed to upload.")
        <span class="text-danger">{{ $message }} {{__('admin.max_size_exceeded')}}</span>
    @else
        <span class="text-danger">{{ $message }}</span>
    @endif
@enderror