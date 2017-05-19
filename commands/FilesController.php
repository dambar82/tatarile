<?php
namespace app\commands;

use yii\console\Controller;
use Yii;

class FilesController extends Controller
{
    public function actionIndex()
    {
        $mainDir = 'web/';
        $createDirs = ['files','files/articles','files/audio','files/avatars','files/pdf','files/thumb','files/video'];
        foreach ($createDirs as $createDir) {
            if (!file_exists($mainDir.$createDir)) {
                mkdir($mainDir.$createDir);
            }
        }
        return 'created';
    }
}