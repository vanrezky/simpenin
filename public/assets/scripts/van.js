function notification($title, $message, $infoLanjut) {
    const notif = $("#notification-1");
    notif.find('[title]').empty().append($title);
    notif.find('[desc]').empty().append($message);
    notif.toast('show');
    $("#informasi-lanjut").empty();
    if ($infoLanjut) {
        $("#informasi-lanjut").append($infoLanjut);
    }

    return true;
}


function previewImg(
    id,
    classLabel = ".custom-file-label",
    classPreview = ".img-preview"
) {
    if (id == "undefined" || id == "") {
        return false;
    }

    const sampul = document.querySelector(id);
    // const sampulLabel = document.querySelector(classLabel);
    const imgPreview = document.querySelector(classPreview);

    // sampulLabel.textContent = sampul.files[0].name;

    const fileSampul = new FileReader();
    fileSampul.readAsDataURL(sampul.files[0]);

    if (classPreview != ".file-preview") {
        fileSampul.onload = function (e) {
            imgPreview.src = e.target.result;
        };
    }
}