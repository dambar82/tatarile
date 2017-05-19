<?php

namespace app\modules\admin\controllers;

use app\models\ContactForm;
use app\modules\admin\models\Config;
use app\modules\statistics\models\AdminActionStatistics;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */



class DefaultController extends Controller
{
    public function actionIndex()
    {
        $query = Config::find();

        $configProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index',[
            'configProvider' =>$configProvider,
        ]);
    }
    /**
     * Displays admin contact messages
     */
    public function actionContactMessages()
    {
        $adminMessages = ContactForm::find()->orderBy([
            'date_create' => SORT_DESC
        ])->all();
        $adminMessagesAr = [];
        try {
            foreach ($adminMessages as $adminMessage) {
                $adminMessagesAr[] = [
                    'name' => $adminMessage->name,
                    'status' => $adminMessage->status,
                    'email' => $adminMessage->email,
                    'subject' => $adminMessage->subject,
                    'body' => $adminMessage->body
                ];
                if($adminMessage->status == 1) {
                    //$adminMessage->status = 2;
                    //$adminMessage->save();
                }

            }
            $adminMessagesDataProvider = new ActiveDataProvider([
                'query' => ContactForm::find()->orderBy([
                    'date_create' => SORT_DESC
                ]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->render('messages', [
            'adminMessagesDataProvider' => $adminMessagesDataProvider
        ]);
    }
}
