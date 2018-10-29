<?php
/* @var $entities \app\backend\models\Entity[] */

$lang = \app\models\Lang::getCurrent();
$lang_url = "";
if($lang->id != 2) {
    $lang_url = '/'.$lang->url;
}
?>

<?php if ($entities): ?>
    <div class="section sc-js">
        <div class="container-fluid">
            <div class="view--entity">
                <h2><?= Yii::t('app','ПОПУЛЯРНЫЕ СТАТЬИ'); ?></h2>
                <div class="view--content row">
                    <?php foreach ($entities as $entity): ?>
                        <div class="col-xs-4 col-sm-4 col-md-4 view--row">
                            <div class="row--content">
                                <div class="content--wrap">
                                    <div class="entity--type">
                                        <span class="type-1"></span>
                                    </div>
                                    <div class="entity--img">
                                        <a href="<?= \app\components\ChrestomathyUrlHelper::createEntityUrl($entity->id)?>">
                                            <?= \app\modules\file\widgets\Thumbnail2::widget(['id' => $entity->id])?>
                                        </a>
                                    </div>
                                    <div class="entity--title">
                                        <a href="<?= \app\components\ChrestomathyUrlHelper::createEntityUrl($entity->id)?>">
                                            <?= $entity->eav->value ?>
                                        </a>
                                    </div>
                                    <div class="entity--razdel">
                                        <span><?=\app\components\ChrestomathyGetSubject::getSubjectTitle($entity->category_id)?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="entity--see-all text-center">
                    <a href="http://chrestomathy.tatarile.tatar<?= $lang_url ?>/info"><?= Yii::t('app','Смотреть все статьи'); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$this->registerCss("
   .sc-js .view--entity .entity--img img {
        width: 100%;
        height: inherit;
        object-fit: cover;
   }
   .sc-js .entity-thumbnail {
        height: 280px;
        width: 100%;
   }
");
?>
