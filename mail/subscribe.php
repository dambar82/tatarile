<?php
/* @var $model \app\models\SubscribeText[] */
/* @var $email \app\models\SubscribeEmail */
?>

<?php foreach ($model as $item): ?>
    <a href="<?= $item->href ?>"> <?= $item->title ?></a><br>
<?php endforeach; ?>
<br><br><br>
<a href="http://tatarile.tatar/subscribe/unsubscribe?hash=<?= $email->hash ?>">отписаться от рассылки</a>
