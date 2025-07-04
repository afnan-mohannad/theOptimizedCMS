const toggle_current_password = document.querySelector("#toggle-current-password");
const current_password = document.querySelector("#current-password");

toggle_current_password.addEventListener("click", function () {
    // toggle the type attribute
    const type = current_password.getAttribute("type") === "password" ? "text" : "password";
    current_password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});



const toggle_confirm_password = document.querySelector("#toggle-password");
const confirm_password = document.querySelector("#password");

toggle_confirm_password.addEventListener("click", function () {
    // toggle the type attribute
    const type = confirm_password.getAttribute("type") === "password" ? "text" : "password";
    confirm_password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});


const toggle_password = document.querySelector("#toggle-new-password");
const password = document.querySelector("#password-confirm");

toggle_password.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});

window.addEventListener('swal:passwordNotMatch', function(event){
    swal.fire({
        title:event.detail[0].title,
        html:event.detail[0].html,
        showCloseButton:false,
        showCancelButton:true,
        cancelButtonText:event.detail[0].yes,
        cancelButtonColor:'#d33',
        width:300,
        allowOutsideClick:false
    })
});

