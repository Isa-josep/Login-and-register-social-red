function init(){
    $("#mnt_form").on("submit", function(e){
        register(e);
    });
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