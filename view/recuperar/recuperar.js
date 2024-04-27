console.log("DEBUG");

$(document).ready(function() {
    

});

$(document).on("click", "#btnrecuperar", function() {
    var usu_correo = $("#usu_correo").val();
    $.post("../../controller/email.php?op=recuperar",{
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
                text: "Ocurrio Un Error Por Nuetra Parte Intente Mas tarde!",
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
    });
});
