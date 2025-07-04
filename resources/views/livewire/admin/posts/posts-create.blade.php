<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <form class="form d-flex flex-column flex-lg-row" wire:submit.prevent='submit'>
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-500px mb-7 me-lg-10">
                    <!--begin::Category & tags-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('admin.posts.Post Details')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        @if(isset($categories) && !empty($categories))
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Label-->
                                <label class="form-label required">
                                    {{__('admin.Category')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-control="select2" class="form-select mb-2" data-placeholder="{{__('admin.Select an option')}}" id="category_id" wire:model="category_id">
                                    <option value="{{null}}">{{__('admin.Select an option')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{$category_slug == $category->slug? 'selected' : ""}}>
                                            {{ucfirst($category->translate(lang())->name)}}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                                @include('livewire.admin.error', ['property' => 'category_id'])
                            </div>
                            <!--end::Card body-->
                        @endif
                        @if (isset($tags) && !empty($tags))
                            <!--begin::Card body-->
                            <div class="card-body pt-0" wire:ignore>
                                <!--begin::Input group-->
                                <!--begin::Label-->
                                <label class="form-label">{{__('admin.Tags')}}</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select mb-2" data-placeholder="{{__('admin.Select an option')}}" id="tags" multiple wire:model.live="tag_ids">
                                    <option value="{{null}}">{{__('admin.Select an option')}}</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->slug}}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                                <!--end::Input group-->
                                @include('livewire.admin.error', ['property' => 'tag_ids'])
                            </div>
                            <!--end::Card body-->
                        @endif
                    </div>
                    <!--end::Category & tags-->
                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('admin.Status')}}</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px"></div>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0" wire:ignore>
                            <!--begin::Select2-->
                            <select data-control="select2" class="form-select mb-2" data-placeholder="{{__('admin.Select Status')}}" wire:model="status" id="status">
                                <option value="PUBLISHED">{{__('admin.posts.PUBLISHED')}}</option>
                                <option value="DRAFT">{{__('admin.posts.DRAFT')}}</option>
                                <option value="PENDING">{{__('admin.posts.PENDING')}}</option>
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">{{__('admin.posts.set_status')}}</div>
                            <!--end::Description-->
                            @include('livewire.admin.error', ['property' => 'status'])
                        </div>
                        <!--end::Card body-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('admin.Active')}}</h2>
                            </div>
                            <div class="menu-item px-3 mt-3">
                                <div class="menu-content px-3">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active"/>
                                        <span class="form-check-label text-muted fs-7"></span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Menu item-->
                            @include('livewire.admin.error', ['property' => 'is_active'])
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('admin.posts.Feature')}}</h2>
                            </div>
                            <div class="menu-item px-3 mt-3">
                                <div class="menu-content px-3">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" wire:model="featured" id="featured" />
                                        <span class="form-check-label text-muted fs-7"></span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Card header-->
                        @include('livewire.admin.error', ['property' => 'featured'])
                    </div>
                    <!--end::Status-->
                    <div class="fv-row mb-7">
                       <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{__('admin.banners.Picture')}}
                                    </h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <!--begin::Image input placeholder-->
                                    @if ($picture)
                                        <style>
                                        .image-input-placeholder { background-image: url('{{ $picture->temporaryUrl() }}'); } [data-theme="dark"] .image-input-placeholder { background-image: url('{{ $picture->temporaryUrl() }}'); }
                                        </style>
                                    @endif
                                    <!--end::Image input placeholder-->
                                    <a @if($picture) href="{{ $picture->temporaryUrl() }}" target="_blank" @endif>
                                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true" wire:ignore>
                                            <div class="image-input-wrapper w-150px h-150px"></div>
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('admin.Edit')}}">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" wire:model="picture" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{__('admin.Cancel')}}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{__('admin.Remove')}}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                    </a>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                        {{__('admin.allowed_images_types')}} 
                                    </div>
                                    <!--end::Description-->
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading" style="text-align: center">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        @include('livewire.admin.error', ['property' => 'picture'])
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{__('admin.posts.Cover Picture')}}
                                        <div class="text-muted fs-7">(1200x600)</div>
                                    </h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <!--begin::Image input placeholder-->
                                    @if ($picture)
                                        <style>
                                        .image-input-placeholder { background-image: url('{{ $picture->temporaryUrl() }}'); } [data-theme="dark"] .image-input-placeholder { background-image: url('{{ $picture->temporaryUrl() }}'); }
                                        </style>
                                    @endif
                                    <!--end::Image input placeholder-->
                                    <a @if($cover_picture) href="{{ $cover_picture->temporaryUrl() }}" target="_blank" @endif>
                                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true" wire:ignore>
                                            <div class="image-input-wrapper w-150px h-100px"></div>
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('admin.Edit')}}">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" wire:model="cover_picture" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{__('admin.Cancel')}}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{__('admin.Remove')}}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                    </a>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                        {{__('admin.allowed_images_types')}}
                                    </div>
                                    <!--end::Description-->
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading" style="text-align: center">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        @include('livewire.admin.error', ['property' => 'cover_picture'])
                    </div>
                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" role="tab-panel" id="kt_ecommerce_add_product_general">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{__('admin.General')}}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Label-->
                                        <label class="required form-label">
                                            {{__('admin.Language')}}
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select data-control="select2" class="form-select mb-2 @error('locale')
                                        is-invalid @enderror" wire:model="locale" id="locale" data-placeholder="{{__('admin.Select Locale')}}">
                                            <option value="{{null}}">{{__('admin.Select an option')}}</option>
                                            <option value="en">{{__('admin.English')}}</option>
                                            <option value="ar">{{__('admin.Arabic')}}</option>
                                        </select>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">{{__('admin.posts.set_language')}}</div>
                                        <!--end::Description-->
                                        @include('livewire.admin.error', ['property' => 'locale'])
                                    </div>
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Title')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" wire:model="title" id="title" class="form-control mb-2 @error('title') is-invalid @enderror" placeholder="{{__('admin.Title')}}" autofocus required/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('admin.posts.note1')}}</div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'title'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Excerpt')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control mb-2 @error('excerpt') is-invalid @enderror form-control-solid" rows="4" wire:model="excerpt"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">
                                                {{__('admin.posts.note3')}}
                                            </div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'excerpt'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div wire:ignore>
                                            <!--begin::Label-->
                                            <label class="form-label">{{__('admin.Body')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea id="tinyeditor" class="richText form-control mb-2 @error('body') is-invalid @enderror form-control-solid" rows="4" wire:model="body"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('admin.posts.note2')}}</div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'body'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mt-5">
                                            <!--begin::Label-->
                                            <label class="form-label">{{__('admin.Date')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid mb-2 @error('created_at') is-invalid @enderror" placeholder="Pick a date" wire:model="created_at" id="kt_datepicker_1"/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'created_at'])
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                            <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <!--begin::Submit-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('app.posts.index')}}" class="btn btn-light me-5">{{__('admin.Cancel')}}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary bg-color">
                            @include('livewire.admin.loading', ['buttonName' => __('admin.Create')])
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Submit-->
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    <input type="hidden" name="lang" id="lang" value="{{lang()}}">
</div>
<!--end::Content-->
@push('js')
    <script src="https://cdn.tiny.cloud/1/{{config('customConfig.tiny_mce_api_key')}}/tinymce/6/tinymce.min.js" referrerpolicy="origin" ></script>
    <script>
        $(document).ready(function() {
            $('#tags').select2();

            $('#tags').on('change', function(e) {
                @this.set('tag_ids', $(this).val());
            });
            $('#category_id').on('change', function(e) {
                @this.set('category_id', $(this).val());
            });
            $('#locale').on('change', function(e) {
                @this.set('locale', $(this).val());
            });
            $('#status').on('change', function(e) {
                @this.set('status', $(this).val());
            });
        });
        if(theme == "light")
            tinymce.init({
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function (e) {
                        @this.set('body', editor.getContent());
                    });
                },
                height: 700,
                toolbar_mode:'wrap',
                language:'en',
                selector: 'textarea.richText',
                convert_urls: false,
                plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount codesample code',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat codesample code',
                media_live_embeds: true,
                image_title: true,
                image_caption: true,
                automatic_uploads: true,
                images_upload_url: '/app/upload',
                file_picker_types: "image",
                image_advtab: true,
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement("input");
                    input.setAttribute("type", "file");
                    if (meta.filetype == "image") {
                        input.setAttribute("accept", "image/*");}

                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = "blobid" + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(",")[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                },
                content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
                iframe_template_callback: (data) =>
                `<iframe title="${data.title}" width="${data.width}" height="${data.height}" src="${data.source}"></iframe>`,
                extended_valid_elements : "video[controls|preload|width|height|data-setup],source[src|type]",
                codesample_languages: [
                    {text: 'HTML/XML', value: 'markup'},
                ],
            });
        else
            tinymce.init({
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function (e) {
                        @this.set('body', editor.getContent());
                    });
                },
                height: 700,
                toolbar_mode:'wrap',
                language:'en',
                selector: 'textarea.richText',
                convert_urls: false,
                plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount codesample code',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat codesample code',
                media_live_embeds: true,
                image_title: true,
                image_caption: true,
                automatic_uploads: true,
                images_upload_url: '/app/upload',
                file_picker_types: "image media",
                image_advtab: true,
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement("input");
                    input.setAttribute("type", "file");
                    if (meta.filetype == "image") {
                        input.setAttribute("accept", "image/*");}

                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = "blobid" + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(",")[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                },
                content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
                iframe_template_callback: (data) =>
                `<iframe title="${data.title}" width="${data.width}" height="${data.height}" src="${data.source}"></iframe>`,
                extended_valid_elements : "video[controls|preload|width|height|data-setup],source[src|type]",
                skin: 'oxide-dark',
                content_css: 'dark',
                codesample_languages: [
                    {text: 'HTML/XML', value: 'markup'},
                ],
            });
    </script>
    <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/post.js" defer></script>
@endpush