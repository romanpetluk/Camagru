var video = document.getElementById("video");

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}

var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var video = document.getElementById("video");

var btn_snap = document.querySelector(".camera__btn");
var btn_save = document.querySelector(".save__btn");

var btn_image = document.querySelectorAll("button[name=filter]");
var filter_image = document.querySelector(".camera__image");

var filter_value = "";
var filter_src = "";

for (var i = 0, length = btn_image.length; i < length; i++) {
    btn_image[i].addEventListener("click", handlerImage);
}

function handlerImage(e) {
    e.preventDefault();
    filter_image.style.display = "block";
    btn_snap.disabled = false;
    filter_image.src = e.target.src;
    filter_value = e.target.getAttribute("data-value");
    filter_src = e.target.getAttribute("src");
}

btn_snap.addEventListener("click", function() {
    context.drawImage(video, 0, 0, 640, 480);
    btn_save.classList.remove("display-hidden");
    btn_snap.classList.add("display-hidden");
    canvas.classList.add("camera_z_index");
});

btn_save.addEventListener("click", function(e) {
    var img = canvas.toDataURL("image/png").replace("data:image/png;base64,", "");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/photo/selfie", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("img=" + img + "&" + "value=" + filter_value + "&" + "src=" + filter_src);

    filter_image.style.display = "none";
    btn_snap.disabled = true;
    btn_save.classList.add("display-hidden");
    btn_snap.classList.remove("display-hidden");
    canvas.classList.remove("camera_z_index");
});

function convertImageToCanvas(image) {
    var canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    canvas.getContext("2d").drawImage(image, 0, 0);

    return canvas;
}