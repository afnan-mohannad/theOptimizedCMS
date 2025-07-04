"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_user');
    const form = element.querySelector('#kt_modal_add_user_form');
    const modal = new bootstrap.Modal(element);

    // Translation variables 
    const cancel_text = document.getElementById('cancel_text').value;
    const cancel_ok = document.getElementById('cancel_ok').value;
    const cancel_no = document.getElementById('cancel_no').value;
    const cancel_fail = document.getElementById('cancel_fail').value;
    const cancel_success = document.getElementById('cancel_success').value;
    const create_success_ok = document.getElementById('create_success_ok').value;
    const create_success_text = document.getElementById('create_success_text').value;

    // Init add schedule modal
    var initAdd = () => {
        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();
            Swal.fire({
                text: cancel_text,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: cancel_ok,
                cancelButtonText: cancel_no,
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: cancel_fail,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: create_success_ok,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            Swal.fire({
                text: cancel_text,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: cancel_ok,
                cancelButtonText: cancel_no,
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: cancel_success,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: create_success_ok,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
        
        window.addEventListener('createModalToggle', event => {
            // Show popup confirmation 
            Swal.fire({
                text: create_success_text,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: create_success_ok,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    modal.hide();
                }
            });
            $('#kt_modal_add_user').modal('toggle');
        })

        window.addEventListener('updateModalToggle', event => {
            $('#kt_modal_update_user').modal('toggle');
        })

        window.addEventListener('deleteModalToggle', event => {
            $('#deleteModal').modal('toggle');
        })

        window.addEventListener('showModalToggle', event => {
            $('#showModal').modal('toggle');
        })

        window.addEventListener('swal:deleteBanners', function(event){
            swal.fire({
                title:event.detail[0].title,
                html:event.detail[0].html,
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:event.detail[0].yes,
                confirmButtonText:event.detail[0].no,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false
            }).then(function(result){
                if(result.value){
                    Livewire.dispatch('deleteCheckedBanners',[event.detail[0].checkedIDs]);
                }
            });
        });
    }
    return {
        // Public functions
        init: function () {
            initAdd();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
