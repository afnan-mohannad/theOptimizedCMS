var are_you_sure = document.getElementById('are_you_sure').value;
const you_can_not_return = document.getElementById('you_can_not_return').value;
const yes_delete = document.getElementById('yes_delete').value;
const theme = localStorage.getItem('kt_metronic_theme_mode_value');
const cancel_text = document.getElementById('cancel_text').value;
const cancel_ok = document.getElementById('cancel_ok').value;
const cancel_no = document.getElementById('cancel_no').value;
const delete_success = document.getElementById('delete_success').value;

function deleteData(id) {
    Swal.fire({
        title: are_you_sure,
        text: you_can_not_return,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: yes_delete
    }).then((result) => {
        if (result.value) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}

function cancel() {
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
    }).then((result) => {
        if (result.value) {
            location.href = '/app/dashboard';
        }
    })
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

window.addEventListener('successDelete', event => {
    Swal.fire({
        title: delete_success,
        icon: "success",
        showConfirmButton: false,
        timer: 1500
    });
})

window.addEventListener('scrollToError', event => {
    setTimeout(() => {
        const firstErrorMessage = document.querySelector('.text-danger')

        if (firstErrorMessage !== null) {
            firstErrorMessage.scrollIntoView({ block: 'center', inline: 'center' , behavior: 'smooth'})
        }
    }, 0)
})

window.addEventListener('resetActions', event => {
    var actions = document.querySelectorAll(".actions");
    actions.forEach(action => {
        action.style.display = 'inline';
    });
})

function selected(id){
    var actions = document.getElementById("actions_"+id);
    if (actions.style.display === "none") {
        actions.style.display = "inline";
    } else {
        actions.style.display = "none";
    }
}
function setGroup(){
    var group = document.getElementById("group");
    var addType = document.getElementById("addType");
    var typeField = document.getElementById("type");
    if (addType.value === "group") {
        group.style.display = "none";
        typeField.style.display = "none";
    } else {
        group.style.display = "inline";
        typeField.style.display = "inline";

    }
}

window.addEventListener('deleteModalToggle', event => {
    $('#deleteModal').modal('toggle');
})

window.addEventListener('swal:successUpdate', function(event){
    swal.fire({
        title:event.detail[0].title,
        html:event.detail[0].html,
        cancelButtonText:event.detail[0].yes,
        cancelButtonColor:'#d33',
        width:300,
        allowOutsideClick:false
    })
});

function allSelected(){
    var actions = document.querySelectorAll(".text-end .actions");
    actions.forEach(action => {
        if (action.style.display === "none") {
            action.style.display = "block";
        } else {
            action.style.display = "none";
        }
    });
}

//remove hash from url
setTimeout(function(){
    history.pushState("", document.title, window.location.pathname + window.location.search);
},500)


//color btn theme
var theme_color = '#009ef7'
//solid btn
// document.querySelector('.bg-color').style.backgroundColor = `${theme_color}`;
var root = document.documentElement;
//solid btn
root.style.setProperty('--kt-primary', `${theme_color}`);
//active btn
root.style.setProperty('--kt-primary-active',`${theme_color}CC`);
//active text
root.style.setProperty('--kt-text-primary',`${theme_color}`);
//side menu active
document.querySelector('.aside-menu .menu .menu-item .menu-link.active').style.backgroundColor = `${theme_color}`;
root.style.setProperty('--kt-menu-link-color-active',`${theme_color}`);
root.style.setProperty('--kt-menu-link-color-hover',`${theme_color}`);
root.style.setProperty('--kt-menu-link-color-show',`${theme_color}`);
root.style.setProperty('--kt-menu-link-color-here',`${theme_color}`);
//check btn
root.style.setProperty('--kt-form-check-input-checked-bg-color-solid',`${theme_color}`);
//check box
document.querySelector('.checkbox-wrapper-1 [type=checkbox].substituted:checked + label:before').style.backgroundColor = `${theme_color}`;




