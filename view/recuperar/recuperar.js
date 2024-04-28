console.log("DEBUG");

$(document).ready(function() {
    

});

$(document).on("click", "#btnrecuperar", function() {
    // Desactivar el botón para evitar clics repetidos
    $("#btnrecuperar").prop("disabled", true);

    var usu_correo = $("#usu_correo").val();
    if(usu_correo === '' || usu_correo === null){
        Swal.fire({
            title: "Campo Vacio!",
            text: "Por Favor Ingrese Su Correo Electronico!",
            icon: "warning",
        });
        // Habilitar el botón nuevamente
        $("#btnrecuperar").prop("disabled", false);
        return false;
    } else {
        $.post("../../controller/email.php?op=recuperar", {
            usu_correo: usu_correo
        }, function(data){
            console.log(data);
            if(data=="true"){
                Swal.fire({
                    title: "Cambio!", 
                    text: "Su contraseña se cambio de forma exitosa y se envio al correo electronico:",
                    icon: "success",
                    confirmButtonColor: "#5156be",
                });
            }
            else if(data=="false"){
                Swal.fire({
                    title: "Correo no existe !",
                    text: "El correo ingresado no se encuentra registrado en el sistema!",
                    icon: "error",
                });
            }
            else{
                Swal.fire({
                    title: "Error!",
                    text: "Ocurrio Un Error Por Nuetra Parte Intente Mas tarde!",
                    icon: "question",
                });
            }
            // Habilitar el botón nuevamente
            $("#btnrecuperar").prop("disabled", false);
        }).fail(function() {
            // En caso de error en la solicitud AJAX, habilitar el botón nuevamente
            $("#btnrecuperar").prop("disabled", false);
        });
    }
});
