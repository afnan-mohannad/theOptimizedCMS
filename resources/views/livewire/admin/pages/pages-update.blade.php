<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <form method="POST" class="form d-flex flex-column flex-lg-row" wire:submit.prevent='submit'>
                @csrf
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-12 me-lg-12">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" role="tab-panel">
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
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Title')}} {{ __('admin.(en)') }} 
                                                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>5])}}"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" wire:model="title_en"  wire:keyup="generateSlug" id="title" class="form-control mb-2 @error('title_en') is-invalid @enderror" placeholder="{{__('admin.pages.Enter Page Title')}}"  autofocus/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'title_en'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Title')}} {{__('admin.(ar)') }}
                                                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>5])}}"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" wire:model="title_ar" id="title" class="form-control mb-2 @error('title_ar') is-invalid @enderror" placeholder="{{__('admin.pages.Enter Page Title')}}" autofocus/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'title_ar'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Slug')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" wire:model="slug" id="slug" class="form-control mb-2 @error('slug') is-invalid @enderror" placeholder="{{__('admin.pages.Enter Page Slug')}}">
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'slug'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{__('admin.Excerpt')}} {{ __('admin.(en)') }}
                                                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50000, 'min'=>50])}}"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control mb-2 @error('excerpt_en') is-invalid @enderror form-control-solid" rows="2" wire:model="excerpt_en"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'excerpt_en'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">
                                                {{__('admin.Excerpt')}} {{__('admin.(ar)') }}
                                                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50000, 'min'=>50])}}"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control mb-2 @error('excerpt_ar') is-invalid @enderror form-control-solid" rows="2" wire:model="excerpt_ar"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'excerpt_ar'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row" wire:ignore>
                                            <!--begin::Label-->
                                            <label class="form-label">{{__('admin.Body')}} {{ __('admin.(en)') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control mb-2 @error('body_en') is-invalid @enderror form-control-solid" rows="2" wire:model="body_en" id="rich-textarea-en"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'body_en'])
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row" wire:ignore>
                                            <!--begin::Label-->
                                            <label class="form-label">{{__('admin.Body')}} {{__('admin.(ar)') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control mb-2 @error('body_ar') is-invalid @enderror form-control-solid" rows="2" wire:model="body_ar" id="rich-textarea-he"></textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @include('livewire.admin.error', ['property' => 'body_ar'])
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('app.pages.index')}}" class="btn btn-light me-5">{{__('admin.Cancel')}}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary bg-color">
                            <span class="indicator-label">{{__('admin.Save Changes')}}</span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    <input type="hidden" wire:model="lang" id="lang" value="{{lang()}}">
</div>
<!--end::Content-->
@push('js')
    <script src="https://cdn.tiny.cloud/1/{{config('customConfig.tiny_mce_api_key')}}/tinymce/6/tinymce.min.js" referrerpolicy="origin" ></script>
    <script>
       tinymce.init({
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('body_en', editor.getContent());
                });
            },
            height: 700,
            toolbar_mode:'wrap',
            language:'en',
            selector: 'textarea#rich-textarea-en',
            convert_urls: false,
            plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
            skin: theme == 'dark' ? "oxide-dark" : "snow",
            content_css: theme == 'dark' ? "dark" : "default",
        });
        tinymce.init({
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('body_ar', editor.getContent());
                });
            },
            height: 700,
            toolbar_mode:'wrap',
            language:'en',
            selector: 'textarea#rich-textarea-he',
            convert_urls: false,
            plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
            skin: theme == 'dark' ? "oxide-dark" : "snow",
            content_css: theme == 'dark' ? "dark" : "default",
        });
    </script>
    <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/pages.js" defer></script>
@endpush