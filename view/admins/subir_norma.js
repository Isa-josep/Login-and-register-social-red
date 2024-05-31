let arrimg = [];

function fore(start, end, callback) {
    for (let i = start; i < end; i++) {
        callback(i);
    }
}

let myDropzone = new Dropzone(".dropzone", {
    url: '../../assets', // ruta donde se guardaran los archivos
    maxFilesize: 20,
    maxFiles: 20,
    acceptedFiles: 'application/pdf,.psd',
    addRemoveLinks: true,
    dictRemoveFile: 'Quitar'

});

myDropzone.on("addedfile", files => {
    arrimg.push(files);
    console.log(arrimg);
});

myDropzone.on("removedfile", files => {
    arrimg = arrimg.filter(file => file.name !== files.name);
    console.log(arrimg);
});

function init() {
    $("#producto_form").on("submit", function (e) {
        saveFiles(e);
    });
}

function saveFiles(e) {
    e.preventDefault();
    var formData = new FormData($("#producto_form")[0]);
    var ans = arrimg.length;

    for (var i = 0; i < ans; i++) {
        formData.append('file[]', arrimg[i]);
    }

    $.ajax({
        url: "../../controller/producto.php?op=insert",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            myDropzone.removeAllFiles(true);
            arrimg = [];
            $('#rule_name').val('');
        }
    });
}

init();
