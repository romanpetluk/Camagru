<?php
//    foreach ($photo as $key => $val) {
//    echo '<p><img src="' . $val['path'] . '" width="" height="150">';
//        echo "<form action='/photo/gallery' method='post'";
//        echo '<p><input type="hidden" name="path" value="' . $val['path'] . '">';
//        echo '<input type="submit" name="delete" value="delete"></p>';
//        echo "</form>";
//    }
//?>


<?php foreach ($photo as $key => $val): ?>
    <p><img src="<?php echo $val['path'] ?>" width="" height="150"></p>
    <?php echo 'like: ' . $val['like'] ?>
    <form action='/photo/gallery' method='post'>
        <p><input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
        <input type="submit" name="delete" value="like"></p>
    </form>
<!--    --><?php //foreach ($val['comment'] as $comment){
//        echo $comment['comment'];
//        echo '<br>';
//        echo 'user: ' . $comment['login'];
//        echo '<br>';
//    }  ?>
<!--    <p><input type="hidden" name="path" value="--><?php //echo $val['path'] ?><!--">-->
<!--        <input type="submit" name="delete" value="delete"></p>-->
    <?php foreach ($val['comment'] as $comment): ?>
        <?php echo $comment['comment']; ?>
        <br>
        <?php echo 'user: ' . $comment['login']; ?>
        <br>
<!--    --><?php // debug($_SESSION); ?>
    <?php if ($_SESSION['account']['user_id'] == $comment['user_id']): ?>
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


<?php //if (isset($_SESSION['account']['user_id'])): ?>
<!---->
<!--   -->
<?php //else: ?>
<!---->
<!---->
<?php //endif; ?>



