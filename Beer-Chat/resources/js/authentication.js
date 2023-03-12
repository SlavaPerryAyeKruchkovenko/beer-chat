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
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const eye = document.getElementById('eye')
    eye.onclick = () => {
        const isVisible = authenticationVM.changePasswordVisible("password")
        if(isVisible){
            eye.innerHTML = feather.toSvg('eye-off',{ class: 'eye-btn' })
        }
        else{
            eye.innerHTML = feather.toSvg('eye',{ class: 'eye-btn' })
        }
    }
});
