var timerInterval;

function init(){
    $("#mnt_form").on("submit", function(e){
        e.preventDefault();
        if(isFormValid()){
            register(e);
            console.log("form valid");
        }
        else{
            console.log("form invalid");
            displayValidationMessages();
            alert("Formulario inválido");
        }
    });
}

function isFormValid(){

    return validateEmail() && validateText("usu_nombre") && validatePassword() && validatePasswordMacht();
}

function validateEmail(){
    var email= $("#usu_correo").val();
    var isValid = validator.isEmail(email);
    showErrorMessage("#usu_correo",isValid,"El correo no es válido");
    return isValid;
}

function validateText(fieldID){
    var value = $("#"+fieldID).val();
    var isValid = validator.isLength(value,{min:4});
    showErrorMessage("#"+fieldID ,isValid,"Ingrese Un Nombre De Minimo 4 Caracteres");
    return isValid;
}

function validatePassword(){
    var password = $("#usu_pass").val();
    var isValid = validator.isLength(password,{min:8});
    showErrorMessage("#usu_pass",isValid,"Ingrese Minimo 8 Caracteres");
    return isValid;
}

function validatePasswordMacht(){
    var password = $("#usu_pass").val();
    var password2 = $("#usu_pass_confir").val();
    var isValid = validator.equals(password,password2);
    showErrorMessage("#usu_pass_confir",isValid,"Las contraseñas no coinciden");
    return isValid;
}

function showErrorMessage(fieldSelector,isValid,message){
    var errorField =$(fieldSelector).next(".validation-error");
    errorField.text(isValid ? "" : message);

}

function displayValidationMessages(){
    validateEmail();
    validateText("usu_nombre");
    validatePassword();
    validatePasswordMacht();
}

function register(e){
    e.preventDefault();
    var formData = new FormData($("#mnt_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=registrar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            if(datos=="OK"){
                Swal.fire({
                    title: "Registro!",
                    text: "Se Registro De Forma Correcta: Espere Mientras Es Redireccionado Al inicio!",
                    icon: "success",
                    confirmButtonColor: "#5156be",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: function(){
                        Swal.showLoading();
                        timerInterval = setInterval(function(){
                            var content = Swal.getHtmlContainer();
                            if(!content) return;
                            var timerElement = content.querySelector("b");
                            if(timerElement){
                                timerElement.textContent = (Swal.getTimerLeft()/1000).toFixed(0);
                            }
                        },100);
                    },
                    didClose: function(){
                        clearInterval(timerInterval);
                        window.location.href = "../../index.php";
                    }
                }).then(function(result){

                });
            }
            else if(datos=="Data Duplicada"){
                Swal.fire({
                    title: "Registro!",
                    text: "Correo Ya Registrado!",
                    icon: "error",
                    confirmButtonColor: "#5156be",
                });
            }
            else{
                Swal.fire({
                    title: "Error!",
                    text: "Ocurrio Un Error Por Nuetra Parte Intente Mas tarde!",
                    icon: "question",
                });
            }
            console.log(datos);
        }
    });
}

init();
console.log("debugd");