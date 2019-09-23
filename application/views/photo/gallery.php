
<div class="gallery">

    <div class="gallery__photo">
        <?php foreach ($photo as $key => $val): ?>
                <?php echo $_SESSION['account']['login'] ?>
            <p><img src="<?php echo $val['path'] ?>" width="" height="500"></p>
            <?php echo $val['creation_date']; echo '<br>' ?>
            <?php echo 'like: ' . $val['like'] ?>
            <form action='/photo/gallery' method='post'>
                <p><input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
                    <input type="submit" name="delete" value="like"></p>
            </form>
            <?php foreach ($val['comment'] as $comment): ?>
                <?php echo $comment['comment']; ?>
                <br>
                <?php echo 'user: ' . $comment['login']; ?>
                <br>
                <?php if (isset($_SESSION['account']) && $_SESSION['account']['user_id'] == $comment['user_id']): ?>
                    <form action='/photo/gallery' method='post'>
                        <input type="hidden" name="delete" value="<?php echo $comment['comment_id'] ?>">
                        <input type="submit" value="delete">
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>

            <form action='/photo/gallery' method='post'>
                <textarea rows="4" cols="30" name="comment""></textarea>
                <p><input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
                    <input type="submit"  value="comment"></p>
            </form>

        <?php endforeach; ?>
    </div>
</div>


