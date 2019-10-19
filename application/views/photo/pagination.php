<div class="pagination">
    <?php if ($page['lastPage'] < $page['page']): ?>
        <?php header('Location: http://localhost:8200/photo/gallery/'. $page['lastPage']); ?>
    <?php endif; ?>
    <button><a href="/photo/gallery/1"><<</a></button>
    <?php  if ($page['page'] > 1):?>
        <button><a href="/photo/gallery/<?php echo ($page['page'] - 1)?>"><</a></button>
    <?php endif; ?>
    <span><?php echo $page['page'] ?></span>
    <?php if ($page['lastPage'] > $page['page']): ?>
        <button><a href="/photo/gallery/<?php echo ($page['page'] + 1)?>">></a></button>
    <?php endif; ?>
    <button><a href="/photo/gallery/<?php echo $page['lastPage']?>">>></a></button>
</div>