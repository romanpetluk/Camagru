

<video id="video" width="640" height="480" autoplay></video>
<button id="snap">Snap Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>
<button id="save" type="file">Save Photo</button>

<form action="/photo/selfie" method="post" enctype="multipart/form-data">
<!--    <a href="public/images/image-name.jpg" download>-->
    <button id="save" type="file">Save Photo</button>
</form>


<div id="ajax">

</div>

<script>
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

    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });

    document.getElementById("save").addEventListener("click", function() {
        var image = new Image();
        image.src = canvas.toDataURL("image/png");

        return image;
    });
</script>

    <form action="/photo/selfie" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit">
    </form>


<?php foreach ($photo as $key => $val): ?>
    <p><img src="<?php echo $val['path'] ?>" width="" height="150"></p>
    <form action='/photo/selfie' method='post'
    <p><input type="hidden" name="path" value="<?php echo $val['path'] ?>">
        <input type="submit" name="delete" value="delete"></p>
    </form>
<?php endforeach; ?>