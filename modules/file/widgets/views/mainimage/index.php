<?php if (!empty($img)): ?>
    <div class="entity-mainimage">
        <img class="img-responsive" src="<?=$img?>" alt="<?=$alt?>">
        <?php
        if (!empty($thumbnail_title)) {
            echo '<p>'.$thumbnail_title.'</p>';
        }
        ?>
    </div>
<?php endif;?>