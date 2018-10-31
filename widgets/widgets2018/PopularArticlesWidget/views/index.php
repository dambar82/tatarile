<?php
/* @var $entities \app\backend\models\Entity[] */

$lang = \app\models\Lang::getCurrent();
$lang_url = "";
if($lang->id != 2) {
    $lang_url = '/'.$lang->url;
}
?>

<?php if ($entities): ?>
    <div class="section">
        <div class="container-fluid">
            <div class="view--entity">
                <h2><?= Yii::t('app','ПОПУЛЯРНЫЕ СТАТЬИ'); ?></h2>
                <div class="view--content owl-carousel">
                    <?php foreach ($entities as $entity): ?>
                        <div class="view--row">
                            <div class="row--content">
                                <div class="content--wrap">
                                    <div class="entity--type">
                                        <span class="type-1"></span>
                                    </div>
                                    <div class="entity--img">
                                        <a href="<?= \app\components\UrlHelper::createEntityUrl($entity->id)?>">
                                            <?= \app\modules\file\widgets\Thumbnail::widget(['id' => $entity->id])?>
                                        </a>
                                    </div>
                                    <div class="entity--title">
                                        <a href="<?= \app\components\UrlHelper::createEntityUrl($entity->id)?>">
                                            <?= $entity->eav->value ?>
                                        </a>
                                    </div>
                                    <div class="entity--razdel">
                                        <span><?=\app\components\GetSubject::getSubjectTitle($entity->category_id)?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="entity--see-all text-center">
                    <a href="<?= $lang_url ?>/encyclopedia?category_id=2"><?= Yii::t('app','Смотреть все статьи'); ?></a>
                </div>
            </div>
        </div>
    </div>

<?php
$script = <<< JS
    $(".owl-carousel").owlCarousel({
        loop:true,
        nav: true,
        navText: ["", ""],
        dots: false,
        responsive : {
            0 : {
                items: 1
            },
            800 : {
                items: 2
            },
            1399 : {
                items: 3
            }
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
<?php endif; ?>