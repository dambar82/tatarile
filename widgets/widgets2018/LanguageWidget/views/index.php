<?php
/* @var $current \app\models\Lang */
/* @var $langs \app\models\Lang[] */
?>

<div class="block--lang">
    <ul class="nav nav-pills lang-menu">

        <?php foreach ($langs as $lang): ?>
            <li class="menu--item">
                <?= ($lang->name != $current->name) ? '<a href="/'.$lang->url.Yii::$app->getRequest()->getLangUrl().'">'.mb_substr ($lang->name, 0, 3).'</a>' : '<span>'.mb_substr ($lang->name, 0, 3).'</span>' ?>
            </li>
        <?php endforeach; ?>

    </ul>
</div>


