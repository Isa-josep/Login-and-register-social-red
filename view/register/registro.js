function init(){
    $("#mnt_form").on("submit", function(e){
        e.preventDefault();
        if(isFormValid()){
            register(e);
        }
        else{
            console.log("form invalid");
            displayValidationMessages();
            alert("Formulario inválido");
        }
    });
}

function isFormValid(){

    return validateEmail();
}

function validateEmail(){
    var email= $("#usu_correo").val();
    var isValid = validator.isEmail(email);
    showErrorMessage("#usu_correo",isValid,"El correo no es válido");
    return isValid;
}

function showErrorMessage(fieldSelector,isValid,message){
    var errorField =$(fieldSelector).next(".validation-error");
    errorField.text(isValid ? "" : message);

}

function displayValidationMessages(){
    validateEmail();

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
            console.log(datos);
        }
    });
}

init();
console.log("debugd");