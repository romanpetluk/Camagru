var video = document.getElementById('video');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

var btn_snap = document.querySelector(".camera__btn");
var btn_save = document.querySelector(".save__btn");

btn_snap.addEventListener("click", function() {
    context.drawImage(video, 0, 0, 640, 480);
    btn_save.classList.remove("display-hidden");
    btn_snap.classList.add("display-hidden");
    canvas.classList.add("camera_z_index");
});

btn_save.addEventListener("click", function() {
    var image = new Image();
    image.src = canvas.toDataURL("image/png");
    // btn_save.classList.add("display-hidden");
    // btn_snap.classList.remove("display-hidden");
    // canvas.classList.remove("camera_z_index");
    return image;
});

function convertImageToCanvas(image) {
    var canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    canvas.getContext("2d").drawImage(image, 0, 0);

    return canvas;
}
