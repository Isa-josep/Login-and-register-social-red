console.log("DEBUG");

$(document).ready(function() {
    const url=window.location.href;
    const urlParams = new URLSearchParams(new URL(url).search);
    const confirmar = urlParams.get('id');

    const decode_id= decodeURIComponent(confirmar);
    const id=decode_id.replace(/\s/g, "+");
    console.log(id); 
    
    $.post("../../controller/usuario.php?op=activate",{
        usu_id:id,
        function(data){
            console.log(data);
        }
    })
});
