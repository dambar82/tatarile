<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app','Not found');
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-3 do-not-print">

            </div>
            <div class="col-md-6 col-lg-6">
                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 do-not-print">

            </div>
        </div>
    </div>
</div>
