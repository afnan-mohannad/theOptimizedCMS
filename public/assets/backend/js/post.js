"use strict";

// On document ready
KTUtil.onDOMContentLoaded(function () {

    $("#kt_datepicker_1").flatpickr();

    KTImageInput.createInstances();

    var pictureInputElement = document.querySelector("#kt_picture_input");
    var pictureInput = KTImageInput.getInstance(pictureInputElement);
    pictureInput.on("kt.imageinput.changed", function() {
        $("#delete_picture").hide();
    });

    var coverPictureInputElement = document.querySelector("#kt_cover_picture_input");
    var coverPictureInput = KTImageInput.getInstance(coverPictureInputElement);
    coverPictureInput.on("kt.imageinput.changed", function() {
        $("#delete_cover_picture").hide();
    });
});