const feather = require('feather-icons')

const authenticationVM = {
    changePasswordVisible: (inputId) => {
        const passwordInput = document.getElementById(inputId);
        if(passwordInput && passwordInput.type.toLowerCase() === "password"){
            passwordInput.type = 'text';
            return true;
        }
        else if(passwordInput && passwordInput.type.toLowerCase() === "text"){
            passwordInput.type = 'password';
            return false;
        }
        return true;
    },
    deleteAlert: ()=>{
        const alert = document.getElementById('success-alert')
        alert.parentNode.parentNode.removeChild(alert.parentNode);
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const eyes = document.getElementsByClassName('eye');
    Array.from(eyes).forEach((eye,index)=>{
        const number = index===0?'':index+1
        eye.onclick = () => {
            const isVisible = authenticationVM.changePasswordVisible("password"+number)
            if(isVisible){
                eye.innerHTML = feather.icons['eye-off'].toSvg({ class: 'eye-btn' })
            }
            else{
                eye.innerHTML = feather.icons['eye'].toSvg({ class: 'eye-btn' })
            }
        }
    })
    const closeBtn = document.getElementById('close-alert');
    if(closeBtn){
        closeBtn.addEventListener("click", authenticationVM.deleteAlert, false);
    }
});
