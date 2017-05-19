<?php
use vova07\imperavi\Widget;

$langs = \yii\helpers\ArrayHelper::map(\app\models\Lang::find()->orderBy('id DESC')->all(),'id','url');
?>
<div class="article_content article_content_<?=$seq_index?>">
    <?php
    foreach ($langs as $key => $lang) {
        echo '<div class="col-md-4"><div class="form-group field-articlecontentvalue-'.$seq_index.'-'.$key.'-value">';
        echo '<label class="control-label" for="articlecontentvalue-'.$seq_index.'-'.$key.'-value">'.Yii::t('app',$lang).'</label>';
        echo Widget::widget([
            'name' => 'ArticleContentValue['.$seq_index.']['.$key.'][value]',
            'id' => 'articlecontentvalue-'.$seq_index.'-'.$key.'-value',
            'options' => [
                'data-id' => $key,
            ],
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'fontcolor',
                    'table',
                    'fullscreen',
                ]
            ],
            'plugins' => [
                'linkes' => 'app\assets\ImperaviAsset',
                'longtire' => 'app\backend\assets\ImperaviTireAsset',
                'kavychki' => 'app\backend\assets\KavychkiAsset',
            ]
        ]);
        echo '</div></div>';
    }
    ?>
</div>
<div class="clearfix"></div>