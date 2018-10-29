<?php

namespace app\controllers;

use app\backend\models\EntityTags;
use app\models\Lang;
use app\modules\admin\models\ConfigSeo;
use app\modules\statistics\models\AdminActionStatistics;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public $freeAccess = true;
    protected $stat = 1;

    public function behaviors()
	{
		return [
			'ghost-access'=> [
				'class' => 	'webvimark\modules\UserManagement\components\GhostAccessControl',
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "@app/themes/theme2018/layouts/main";
        return $this->render('@app/themes/theme2018/views/site/index');
    }


    public function actionContact()
    {
        $model = new ContactForm();
        $model->status = $this->stat;
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
            $transaction = Yii::$app->db->beginTransaction();
            $adminActStat = AdminActionStatistics::findOne([
                'name' => 'contact_form',
                'status' => 1
            ]);
            if(!$adminActStat) {
                $adminActStat = new AdminActionStatistics();
                $adminActStat->status = 1;
                $adminActStat->name = 'contact_form';
                $adminActStat->count = 0;
                $adminActStat->views_count = 0;
            }

            try {
                $adminActStat->save();
                $adminActStat->updateCounters(['count' => 1]);
                Yii::$app->session->setFlash('contactFormSubmitted');
                unset($model->verifyCode);
                $model->save(false);
                $transaction->commit();
            }
            catch (Exception $e) {
                $transaction->rollBack();
                throw new NotFoundHttpException('Ne poluchilos - ne fartanulo: '.$e->getMessage());
            }
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionRobots()
    {
        $robots = ConfigSeo::find()->select('value')->where(['title' => 'robots'])->scalar();
        $response = \Yii::$app->response;
        $response->headers->set('Content-Type', 'text/plain');
        $response->format = \yii\web\Response::FORMAT_RAW;
        $response->data = $robots;
        \Yii::$app->end();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionAuth()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('@app/views/site/_auth');
        }
        return $this->redirect('index');
    }
}
