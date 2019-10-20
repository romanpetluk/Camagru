<?php foreach ($photo as $val): ?>
<img class="gallery__img" src="<?php echo $val['path'] ?>" alt="">
<div class="gallery__container">
    <p>
        <span><b><?php echo $val['login'] . ':' ?></b></span>
        <span><?php echo $val['creation_date']; ?></span>
    </p>
    <div class="gallery__likes">
        <span><?php echo 'Like: ' . $val['like'] ?></span>
        <form action='/photo/gallery/<?php echo $page['page'] ?>' method='post'>
            <input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
            <input type="submit" name="delete" value="like">
        </form>
    </div>

    <div class="gallery__comments">
        <?php foreach ($val['comment'] as $comment): ?>
        <div class="gallery__comment">
            <p class="gallery__comment-text"><?php echo $comment['comment']; ?></p>
            <div class="gallery__signature">
                <span><b><?php echo $comment['login']; ?></b></span>
                <?php if (isset($_SESSION['account']) && $_SESSION['account']['user_id'] == $comment['user_id']): ?>
                <form action='/photo/gallery/<?php echo $page['page'] ?>' method='post'>
                    <input type="hidden" name="delete" value="<?php echo $comment['comment_id'] ?>">
                    <input type="submit" value="delete">
                </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
        <form action='/photo/gallery/<?php echo $page['page'] ?>' method='post'>
            <textarea rows="4" cols="30" name="comment""></textarea>
            <p><input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
                <input type="submit"  value="comment"></p>
        </form>
    </div>
<?php endforeach; ?>
</div>
<div class="gallery__pagination">
<?php require_once 'pagination.php'; ?>
</div>
