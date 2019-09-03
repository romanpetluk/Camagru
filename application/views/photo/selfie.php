
<div class="selfie">
    <div class="filters">
        <p>
        <form action='/photo/selfie' method='post'>
            <button type="submit" name="filter" value="1"><img src="/public/images/frame/1.jpg" width="150" height=""></button>
            <button type="submit" name="filter" value="2"><img src="/public/images/frame/2.jpg" width="150" height=""></button>
            <button type="submit" name="filter" value="3"><img src="/public/images/frame/3.jpg" width="150" height=""></button>
        </form>
        </p>

    </div>
    <div class="camera">
        <video class="camera__area" id="video" width="640" height="480" autoplay></video>
        <canvas class="camera__photo" id="canvas" width="640" height="480"></canvas>
        <button class="camera__btn" id="snap">Snap Photo</button>
    
        <!--<button id="save" type="file">Save Photo</button>-->

        <form action="/photo/selfie" method="post" enctype="multipart/form-data" name="save_image">
        <!--    <a href="public/images/image-name.jpg" download>-->
            <button class="save__btn display-hidden" id="save" name="myFile" type="file">Save Photo</button>
        </form>
    </div>

    <div id="ajax">

    </div>
<!--    <script>-->
<!--        var video = document.getElementById('video');-->
<!---->
<!--        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {-->
<!--            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {-->
<!--                video.srcObject = stream;-->
<!--                video.play();-->
<!--            });-->
<!--        }-->
<!---->
<!--        var canvas = document.getElementById('canvas');-->
<!--        var context = canvas.getContext('2d');-->
<!--        var video = document.getElementById('video');-->
<!---->
<!--        var btn_snap = document.querySelector(".camera__btn");-->
<!--        var btn_save = document.querySelector(".save__btn");-->
<!---->
<!--        btn_snap.addEventListener("click", function() {-->
<!--            context.drawImage(video, 0, 0, 640, 480);-->
<!--            btn_save.classList.remove("display-hidden");-->
<!--            btn_snap.classList.add("display-hidden");-->
<!--            canvas.classList.add("camera_z_index");-->
<!--        });-->
<!---->
<!--        btn_save.addEventListener("click", function() {-->
<!--            var image = new Image();-->
<!--            image.src = canvas.toDataURL("image/png");-->
<!--            // btn_save.classList.add("display-hidden");-->
<!--            // btn_snap.classList.remove("display-hidden");-->
<!--            // canvas.classList.remove("camera_z_index");-->
<!--            return image;-->
<!--        });-->
<!--    </script>-->
    <div class="photo__list">
        <form action="/photo/selfie" method="post" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit">
        </form>


        <?php foreach ($photo as $key => $val): ?>
            <div class="photo__part">
                <p>
                    <img src="<?php echo $val['path'] ?>" width="" height="150">
                </p>
                <form action='/photo/selfie' method='post' onSubmit="window.location.reload()">
                    <p>
                        <input type="hidden" name="path" value="<?php echo $val['path'] ?>">
                        <input type="hidden" name="imageId" value="<?php echo $val['image_id'] ?>">
                        <input type="submit" name="delete" value="delete">
                    </p>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>