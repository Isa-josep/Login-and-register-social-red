console.log("DEBUG");

$(document).ready(function() {
    
    $.post("../../controller/email.php?op=recuperar",{
        usu_correo:"isaurini1902@gmail.com",
        function(data){
            console.log(data);
        }
    })
});
