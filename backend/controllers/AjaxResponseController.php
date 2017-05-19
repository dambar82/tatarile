<?php

namespace app\backend\controllers;

use app\backend\helpers\TranslateHelper;
use app\backend\models\ArticleContent;
use app\backend\models\LangMap;
use app\models\Lang;
use Yii;
use yii\helpers\VarDumper;

class AjaxResponseController extends \yii\web\Controller
{
    /*
        Удаление контентных блоков с текстом (редакторы)
    */
    public function actionDelete_article_content()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $content_id = Yii::$app->request->post('content_id');
            $entity_id = Yii::$app->request->post('model_id');
            $content = ArticleContent::findOne(['article_id' => $entity_id,'sequence' => $content_id]);
            if ($content) {
                $content->delete();
            }
            return true;
        }
        return false;
    }

    /*
        генерация содержимого модального окна для модуля translate
    */
    public function actionTranslateModal()
    {
        if (Yii::$app->request->isAjax) {
            $words = [];
            $field = Yii::$app->request->post('field');
            $languages = Lang::find()->all();
            $translates = TranslateHelper::getTranslate();
            foreach ($languages as $language) {
                if (!isset($translates[$language->id][$field])) {
                    $translates[$language->id][$field] = '';
                }
                $words[$language->id] = $translates[$language->id][$field];
            }
            return $this->renderAjax('@app/backend/views/translate/_form',[
                'translate' => $words,
                'field' => $field,
                'languages' => $languages
            ]);
        }
        return false;
    }
    public function actionSaveTranslate()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $field = Yii::$app->request->post();

            $languages = Lang::find()->all();
            $translates = TranslateHelper::getTranslate();
            $message_dir = Yii::getAlias('@app/messages/');

            $translate_key = $field['word'];
            $action = $field['action'];

            if (empty($translate_key)) {
                return false;
            }

            if (LangMap::findOne(['value' => $translate_key]) != NULL) {
                if ($action == 'create') {
                    return false;
                }
            }
            else {
                $m = new LangMap();
                $m->value = $translate_key;
                $m->save();
            }

            foreach ($field as $key => $item) {
                if (($key != 'word') & ($key != 'action')){
                    $translates[$key][$translate_key] = trim($item);
                    $results[$key] = $translates[$key][$translate_key];
                }
            }
            $results['word'] = $translate_key;

            foreach ($languages as $language) {
                $local_dir = $message_dir.$language->local;
                $filename = $local_dir.'/app.php';
                foreach ($translates[$language->id] as $key => $translate) {
                    if (json_decode($translate)) {
                        $translates[$language->id][$key] = json_decode($translate);
                    }
                }

                file_put_contents($filename, "<?php\nreturn " . VarDumper::export($translates[$language->id]) . ";\n", LOCK_EX);
            }

            return $results;
        }
        return false;
    }
}
