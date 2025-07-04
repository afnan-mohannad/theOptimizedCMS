"use strict";

// On document ready
KTUtil.onDOMContentLoaded(function () {

    window.addEventListener('deleteModalToggle', event => {
        $('#deleteModal').modal('toggle');
    })

    window.addEventListener('swal:deletePosts', function(event){
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
                Livewire.dispatch('deleteCheckedPosts',[event.detail[0].checkedIDs]);
            }
        });
    });
    
    $("#kt_datepicker_1").flatpickr();
});

function postDelete(id){
    if(confirm("Are you sure to delete this record?"))
        window.livewire.emit('deletePostListner',id);
}