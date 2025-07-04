
const lang = document.getElementById('lang').value;
if(theme == "light")
    tinymce.init({
        height: 580,
        toolbar_mode:'wrap',
        language:lang,
        selector: 'textarea.richText',
        convert_urls: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
            if (meta.filetype == "media") {
                input.setAttribute("accept", "video/*");}

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
        video_template_callback: function(data) {
            return '<div id="videoWrapper" class="inner-blog-vid-div mt-4"><video id="my-video" class="video-js" controls preload="auto" width="' + data.width + '" height="' + data.height + '"' + (data.poster ? ' poster="' + data.poster + '"' : '') + '>\n' + '<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</video> <div class="overlay-vid-div"></div> <button type="button" id="playPauseBtn" class="play-pause-btn" onclick="togglePlayingVid(this)"> <img id="playPauseIcon" data-play = "'+play+'" data-pause="'+pause+'" src="'+pause_line+'" width="24" height="24" title="Play" alt="Play" /> </button> </div>';
        },
        iframe_template_callback: (data) =>
        `<iframe title="${data.title}" width="${data.width}" height="${data.height}" src="${data.source}"></iframe>`,
        extended_valid_elements : "video[controls|preload|width|height|data-setup],source[src|type]"
    });
else
    tinymce.init({
        height: 580,
        toolbar_mode:'wrap',
        language:lang,
        selector: 'textarea.richText',
        convert_urls: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
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
            if (meta.filetype == "media") {
                input.setAttribute("accept", "video/*");}

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
        video_template_callback: function(data) {
            return '<div id="videoWrapper" class="inner-blog-vid-div mt-4"><video id="my-video" class="video-js" controls preload="auto" width="' + data.width + '" height="' + data.height + '"' + (data.poster ? ' poster="' + data.poster + '"' : '') + '>\n' + '<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</video> <div class="overlay-vid-div"></div> <button type="button" id="playPauseBtn" class="play-pause-btn" onclick="togglePlayingVid(this)"> <img id="playPauseIcon" data-play = "'+play+'" data-pause="'+pause+'" src="'+pause_line+'" width="24" height="24" title="Play" alt="Play" /> </button> </div>';
        },
        iframe_template_callback: (data) =>
        `<iframe title="${data.title}" width="${data.width}" height="${data.height}" src="${data.source}"></iframe>`,
        extended_valid_elements : "video[controls|preload|width|height|data-setup],source[src|type]",
        skin: 'oxide-dark',
        content_css: 'dark'
    });
