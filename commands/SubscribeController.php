<?php

namespace app\commands;

use app\backend\models\Entity;
use app\components\UrlHelper;
use app\models\SubscribeEmail;
use app\models\SubscribeText;
use app\modules\file\widgets\Thumbnail;
use app\modules\file\widgets\Thumbnail3;
use yii\console\Controller;
use yii\db\Expression;

class SubscribeController extends Controller
{

    public function actionIndex()
    {
        global $config;
        $config['params']['entity_type_for_eav'] = 'article';

        $entities = Entity::find()
            ->where(['status' => 1])
            ->innerJoinWith(['eav'])
            ->orderBy(new Expression('rand()'))
            ->limit(6)
            ->all();

        foreach ($entities as $entity) {
            $subscribeText = new SubscribeText();
            $subscribeText->title = $entity->eav->value;
            $subscribeText->href = 'http://tatarile.tatar' . UrlHelper::createEntityUrl($entity->id);
            $subscribeText->img = Thumbnail3::widget(['id' => $entity->id]);
            $subscribeText->save();
        }
    }

    public function actionSend()
    {
        $subscribeText = SubscribeText::find()->all();

        $subscribeEmails = SubscribeEmail::find()->all();

        $mailer = \Yii::$app->mailer;
        $messages = [];

        foreach ($subscribeEmails as $email) {

            $messages[] = $mailer->compose('subscribe', [
                'model' => $subscribeText,
                'email' => $email
            ])
                ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->params['adminName']])
                ->setTo($email->email)
                ->setSubject('Рассылка');

        }
        SubscribeText::deleteAll();
        $mailer->sendMultiple($messages);
    }

}
