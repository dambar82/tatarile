<?php

?>

<a href="<?=\yii\helpers\Url::to('/admin/config/update?id='.$model->id)?>" class="list-group-item">
    <i class="fa fa-cog"></i> </i> <?= \yii\helpers\Html::encode($model->title) ?>
     <span class="pull-right text-muted small" style="margin-right:15px;">
         <em><?=$model->value?></em>
         <button type="button" class="close" aria-label="Close" style="position:absolute;right:4px;top:0px;">
             <span aria-hidden="true">&times;</span>
         </button>
     </span>
</a>
