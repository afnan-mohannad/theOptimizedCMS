"use strict";

// On document ready
KTUtil.onDOMContentLoaded(function () {

    window.addEventListener('deleteModalToggle', event => {
        $('#deleteModal').modal('toggle');
    })

    window.addEventListener('swal:deleteSubscribers', function(event){
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
                Livewire.dispatch('deleteCheckedSubscribers',[event.detail[0].checkedIDs]);
            }
        });
    });
});

$("#kt_datepicker_1").flatpickr();

function subscriberDelete(id){
    alert(id);
    if(confirm("Are you sure to delete this record?"))
        window.livewire.emit('deleteSubscriberListner',id);
}