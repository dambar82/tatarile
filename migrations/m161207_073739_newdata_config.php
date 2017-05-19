<?php

use yii\db\Migration;

class m161207_073739_newdata_config extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('config', ['title','value'], [
            ['allowedVideoExtensions','mpeg,mp4'],
            ['allowedImageExtensions','jpg,png'],
            ['allowedAudioExtensions','mp3'],
            ['allowedPdfExtensions','pdf'],
            ['maxImageSize','800'],
            ['maxVideoSize','50000'],
            ['maxPdfSize','50000'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('config', ['title' => 'allowedVideoExtensions']);
        $this->delete('config', ['title' => 'allowedImageExtensions']);
        $this->delete('config', ['title' => 'allowedAudioExtensions']);
        $this->delete('config', ['title' => 'allowedPdfExtensions']);
        $this->delete('config', ['title' => 'maxImageSize']);
        $this->delete('config', ['title' => 'maxVideoSize']);
        $this->delete('config', ['title' => 'maxPdfSize']);
    }
}
