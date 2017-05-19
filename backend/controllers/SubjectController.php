<?php

namespace app\backend\controllers;

use Yii;
use app\backend\models\Subject;
use app\backend\models\SubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\backend\models\SubjectEav;
use app\backend\models\SubjectProperty;
use app\models\Lang;
use yii\web\UploadedFile;

/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAll()
    {
        $subjects = Subject::find()->all();
        $result =[];
        foreach ($subjects as $subject) {
            if ($subject->parent_id == 0) {
                $result[$subject->id]['subject'] = $subject;
            }
            else {
                $result[$subject->parent_id]['subsubject'][] = $subject;
            }
        }

        return $this->render('parent/index',[
            'subjects' => $result
        ]);
    }


    public function actionIndex()
    {
        $subjects = Subject::find()->all();
        $result =[];
        foreach ($subjects as $subject) {
            if ($subject->parent_id == 0) {
                $result[$subject->id]['subject'] = $subject;
            }
            else {
                $result[$subject->parent_id]['subsubject'][] = $subject;
            }
        }

        return $this->render('parent/index',[
            'subjects' => $result
        ]);
    }

    /**
     * Displays a single Subject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $properties = '';
        if (isset($id)) {
            $propertiesByLang = SubjectEav::find()->where(['subject_id' => $id])->all();
            if (isset($propertiesByLang))
            {
                foreach ($propertiesByLang as $p){
                    $properties[$p->lang_id][] = $p;
                }
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'properties' => $properties,
        ]);
    }

    /**
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd_sub($id)
    {
        $model = new Subject();
        $model->parent_id = $id;
        $model->date_status = 0;
        $model->author = 1;
        $properties = SubjectProperty::find()->all();
        $languages = Lang::find()->all();
        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = new SubjectEav();
                $model_eav[$property->id][$lang->id]->property_id = $property->id;
                $model_eav[$property->id][$lang->id]->lang_id = $lang->id;
            }
        }

        if (isset($_POST['SubjectEav'])) {
            $model->save();
            foreach ($_POST['SubjectEav'] as $lang_key=>$lang) {
                foreach ($lang as $prop_key=>$property) {
                    $model_eav[$prop_key][$lang_key]->value = $property['value'];
                    $model_eav[$prop_key][$lang_key]->subject_id = $model->id;
                    $model_eav[$prop_key][$lang_key]->save();
                }
            }
            return $this->redirect(['all']);
        }
        else {
            return $this->render('parent/_sub', [
                'model' => $model,
                'model_eav' => $model_eav,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Subject();

        $properties = SubjectProperty::find()->all();
        $languages = Lang::find()->all();
        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = new SubjectEav();
                $model_eav[$property->id][$lang->id]->property_id = $property->id;
                $model_eav[$property->id][$lang->id]->lang_id = $lang->id;
            }
        }

        if ($model->load(Yii::$app->request->post())) { //если запрос на сохранение
            $filename = UploadedFile::getInstance($model,"filename");

            if($filename) {
                $fileimg = '/images/'.md5($filename->baseName. date("YmdHms")) .'.'. $filename->extension;
                $model->filename = $fileimg;
                $filename->saveAs(Yii::getAlias('@webroot').$fileimg);
            }

            $model->save();
            foreach ($_POST['SubjectEav'] as $lang_key=>$lang) {
                foreach ($lang as $prop_key=>$property) {
                    $model_eav[$prop_key][$lang_key]->value = $property['value'];
                    $model_eav[$prop_key][$lang_key]->subject_id = $model->id;
                    $model_eav[$prop_key][$lang_key]->save();
                }
            }
            return $this->redirect(['index']);
        }
        else { //если запрос на создание
            return $this->render('create', [
                'model' => $model,
                'model_eav' => $model_eav,
            ]);
        }
    }

    public function actionUpdate_sub($id)
    {
        $model = $this->findModel($id);
        $properties = SubjectProperty::find()->all();
        $languages = Lang::find()->all();

        $subject_eav = SubjectEav::find()->where(['subject_id' => $id])->all();
        foreach ($subject_eav as $temp) {
            $temp_eav[$temp->property_id][$temp->lang_id] = $temp->value;
        }
        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = SubjectEav::findOne(['property_id' => $property->id, 'lang_id' => $lang->id, 'subject_id' => $id]);
                if (!isset($model_eav[$property->id][$lang->id])) {
                    $model_eav[$property->id][$lang->id] = new SubjectEav();
                    $model_eav[$property->id][$lang->id]->subject_id = $id;
                    $model_eav[$property->id][$lang->id]->property_id = $property->id;
                    $model_eav[$property->id][$lang->id]->lang_id = $lang->id;
                    $model_eav[$property->id][$lang->id]->value = isset($temp_eav[$property->id][$lang->id]) ? $temp_eav[$property->id][$lang->id] : '';
                }

            }
        }

        if (isset($_POST['SubjectEav'])) {
            $model->save(true);
            foreach ($_POST['SubjectEav'] as $lang_key=>$lang) {
                foreach ($lang as $prop_key=>$property) {
                    $model_eav[$prop_key][$lang_key]->value = $property['value'];
                    $model_eav[$prop_key][$lang_key]->save();
                }
            }
            return $this->redirect(['all']);
        }
        else {
            return $this->render('parent/_sub', [
                'model' => $model,
                'model_eav' => $model_eav,
            ]);
        }

    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileold = $model->filename;

        $properties = SubjectProperty::find()->all();
        $languages = Lang::find()->all();

        $subject_eav = SubjectEav::find()->where(['subject_id' => $id])->all();
        foreach ($subject_eav as $temp) {
            $temp_eav[$temp->property_id][$temp->lang_id] = $temp->value;
        }

        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = SubjectEav::findOne(['property_id' => $property->id, 'lang_id' => $lang->id, 'subject_id' => $id]);
                if (!isset($model_eav[$property->id][$lang->id])) {
                    $model_eav[$property->id][$lang->id] = new SubjectEav();
                    $model_eav[$property->id][$lang->id]->subject_id = $id;
                    $model_eav[$property->id][$lang->id]->property_id = $property->id;
                    $model_eav[$property->id][$lang->id]->lang_id = $lang->id;
                    $model_eav[$property->id][$lang->id]->value = isset($temp_eav[$property->id][$lang->id]) ? $temp_eav[$property->id][$lang->id] : '';
                }

            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $filename = UploadedFile::getInstance($model,"filename");

            if($filename) {
                $fileimg = '/images/'.md5($filename->baseName. date("YmdHms")) .'.'. $filename->extension;
                $model->filename = $fileimg;
                $filename->saveAs(Yii::getAlias('@webroot').$fileimg);
            }
            else {
                $model->filename = $fileold;
            }
            $model->save(true);
            foreach ($_POST['SubjectEav'] as $lang_key=>$lang) {
                foreach ($lang as $prop_key=>$property) {
                    $model_eav[$prop_key][$lang_key]->value = $property['value'];
                    $model_eav[$prop_key][$lang_key]->save();
                }
            }
            return $this->redirect(['index']);
        } else {

            return $this->render('update', [
                'model' => $model,
                'model_eav' => $model_eav,
            ]);
        }
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSubSubjects()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            return Subject::getAllSubSubjectsWithLang($id);
        }
    }
}
