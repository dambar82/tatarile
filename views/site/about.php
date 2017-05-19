<?php
use yii\helpers\Html;

$this->title = Yii::t('app','About the project title');
?>
<div class="main_block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <h1 class="title" id="page-title"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="basic-page site-about">
                <?=Yii::t('app','About the project')?>
                <p><?=Yii::t('app','Partners')?>:</p>
                <ul>
                    <li>Институт татарской энциклопедии АН РТ </li>
                    <li>Казанский федеральный университет</li>
                    <li>Институт истории имени Ш. Марджани АН РТ </li>
                    <li>Институт языка, литературы и искусства имени Г. Ибрагимова АН РТ   </li>
                    <li>Министерство культуры Республики Татарстан </li>
                    <li>Республиканское агентство по печати и массовым коммуникациям «Татмедиа» </li>
                    <li>Национальная библиотека РТ</li>
                    <li>Национальный музей РТ</li>
                    <li>Всемирный конгресс татар </li>
                    <li>ГБУ «Республиканский центр развития традиционной культуры»</li>
                    <li>Центр информационных технологий РТ </li>
                </ul>
                <p><strong><?=Yii::t('app','School electronic library')?> </strong><?=Yii::t('app','About the project footer')?>
                </p>
                <p><strong><?=Yii::t('app','School electronic library')?> </strong><?=Yii::t('app','About the project footer2')?>
                </p>

            </div>
        </div>
    </div>
</div>
