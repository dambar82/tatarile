<?php

namespace app\commands;

use app\backend\models\Entity;
use app\components\UrlHelper;
use app\models\SubscribeEmail;
use app\models\SubscribeText;
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
            ->limit(10)
            ->all();

        $str = '';

        foreach ($entities as $entity) {
            $str.= '<a href="http://tatarile.tatar'.UrlHelper::createEntityUrl($entity->id).'">' . $entity->eav->value . '</a><br>';
        }

        $subscribeText = new SubscribeText();
        $subscribeText->text = $str;
        $subscribeText->save();

    }

    public function actionSend()
    {
        $subscribeText = SubscribeText::find()->one();

        $subscribeEmails = SubscribeEmail::find()->all();

        $mailer = \Yii::$app->mailer;
        $messages = [];

        foreach ($subscribeEmails as $email) {
            $messages[] = $mailer->compose()
                ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->params['adminName']])
                ->setTo($email->email)
                ->setSubject('Рассылка')
                ->setHtmlBody($subscribeText->text);

        }

        $mailer->sendMultiple($messages);
    }

}
