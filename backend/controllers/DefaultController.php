<?php

namespace app\backend\controllers;

use app\backend\models\Entity;
use app\backend\models\EntityCalendar;
use app\backend\models\EntityType;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCalendarEntity()
    {
        $calendar = EntityCalendar::find()->all();
        $events =[];

        $entities = Entity::find()->all();
        $entity = ArrayHelper::map($entities,'id','title');

        foreach ($calendar as $event) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $event->id;
            $Event->title = $entity[$event->entity_id];
            $Event->start = date('Y-m-d',$event->date);
            $Event->url = \yii\helpers\Url::to(['/backend/default/update', 'id'=>$event->id]);
            $events[] = $Event;
        }
        return $this->render('calendar',[
            'events' => $events
        ]);
    }

    public function actionCreate()
    {
        $type = \Yii::$app->request->get('id');

        if (empty($type)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($type == 'article') {
            $entity = ArrayHelper::map(Entity::find()->where(['entity_type_id' => 1,'status' => 1])->all(),'id','title');
            $entity_type =1;
        }
        else {
            $entity = ArrayHelper::map(Entity::find()->where(['<>', 'entity_type_id', 1])->andWhere(['status' => 1])->all(),'id','title');
            $entity_type =0;
        }

        if (!$entity) {
            throw new NotFoundHttpException('Нет данных для создания календаря. Пожалуйста введите статьи (видео и т.д.).');
        }

        $model = new EntityCalendar();
        $model->date = date('d-m-Y');

        if ($model->load(\Yii::$app->request->post())) {
            if (!empty($model->date)) {
                $model->date = strtotime($model->date);
                $model->entity_type = $entity_type;
                if (($model2 = EntityCalendar::findOne(['date' => $model->date, 'entity_type' => $entity_type])) != NULL) {
                    $model2->entity_id = $model->entity_id;
                    $model2->save(false);
                }
                else {
                    $model->save(false);
                }

                return $this->redirect(Url::to('/backend/default/calendar-entity'));
            }
        }

        return $this->render('_form',[
            'type' => $type,
            'model' => $model,
            'entity' => $entity
        ]);

    }

    public function actionUpdate($id)
    {
        if (($model = EntityCalendar::findOne($id)) == NULL) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->entity_type == 1) {
            $entity = ArrayHelper::map(Entity::find()->where(['entity_type_id' => 1,'status' => 1])->all(),'id','title');
        }
        else {
            $entity = ArrayHelper::map(Entity::find()->where(['<>', 'entity_type_id', 1])->andWhere(['status' => 1])->all(),'id','title');
        }

        if (!$entity) {
            throw new NotFoundHttpException('Нет данных для создания календаря. Пожалуйста введите статьи (видео и т.д.).');
        }

        $model->date = date('d-m-Y',$model->date);

        if ($model->load(\Yii::$app->request->post())) {
            if (!empty($model->date)) {
                $model->date = strtotime($model->date);
                $model->save(false);

                return $this->redirect(Url::to('/backend/default/calendar-entity'));
            }
        }
        else {
            return $this->render('_form',[
                'type' => $model->entity_type,
                'model' => $model,
                'entity' => $entity
            ]);
        }
    }

}
