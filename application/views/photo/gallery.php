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
    <form action='/photo/gallery' method='post'
        <p><input type="hidden" name="image_id" value="<?php echo $val['image_id'] ?>">
        <input type="submit" name="delete" value="like"></p>
    </form>
<?php endforeach; ?>


<?php //if (isset($_SESSION['account']['user_id'])): ?>
<!---->
<!--   -->
<?php //else: ?>
<!---->
<!---->
<?php //endif; ?>



