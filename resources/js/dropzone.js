document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#dropzone")) {
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store",
            dictDefaultMessage: "Sube hasta 10 imagenes",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg"
        });
    }
});
