<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 14.11.2016
 * Time: 13:17
 */

use yii\helpers\Html;
?>
<ul id="langs" class="nav nav-pills">
    <?php foreach ($langs as $lang):?>
        <li class="item-lang">
            <?php
                if ($lang->name != $current->name)
                    print '<a href="/'.$lang->url.Yii::$app->getRequest()->getLangUrl().'">'.mb_substr ($lang->name, 0, 3).'</a>';
                else
                    print '<span>'.mb_substr ($lang->name, 0, 3).'</span>';
            ?>
        </li>
    <?php endforeach;?>
</ul>
