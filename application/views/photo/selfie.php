
<div class="selfie">
    <div class="filters">
        <p>
        <form action='/photo/selfie' method='post'>
            <button type="submit" name="filter"><img data-value="1" src="/public/images/frame/1.png" width="150" height=""></button>
            <button type="submit" name="filter"><img data-value="2" src="/public/images/frame/2.png" width="150" height=""></button>
            <button type="submit" name="filter"><img data-value="3" src="/public/images/frame/3.png" width="150" height=""></button>
            <button type="submit" name="filter"><img data-value="4" src="/public/images/frame/4.png" width="150" height=""></button>
        </form>
        </p>

    </div>

    <div class="camera">
        <video class="camera__area" id="video" width="640" height="480" autoplay></video>
        <canvas class="camera__photo" id="canvas" width="640" height="480"></canvas>
        <img class="camera__image" src="" alt="" width="640" height="480">
        <button class="camera__btn" id="snap" disabled>Snap Photo</button>


        <button class="save__btn display-hidden" id="save" name="myFile" type="file">Save Photo</button>
    </div>

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
                <form action='/photo/selfie' method='post'">
                    <p>
                        <input type="hidden" name="path" value="<?php echo $val['path'] ?>">
                        <input type="hidden" name="imageId" value="<?php echo $val['image_id'] ?>">
<!--                        --><?php //unset($photo[$key]) ?>
<!--                        --><?php //unset($val) ?>
                        <input type="submit" name="delete" value="delete">
                    </>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="/public/scripts/selfie.js"></script>