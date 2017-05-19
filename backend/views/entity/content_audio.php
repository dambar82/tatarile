<?php

use kartik\file\FileInput;

$upload_dir = Yii::getAlias("@web").'/files/audio/';
?>
<div class="col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm btn-top-margin">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript://" class="js_add_audio"><i class="fa fa-file-audio-o" aria-hidden="true"></i> Аудиофайл</a></li>
                    </ul>
                </div>
            </div>
            <h3 class="panel-title"><i class="fa fa-paragraph"></i> Аудиофайл</h3>
        </div>
        <div class="panel-body content_body">
            <?php if (!empty($model_audio)) {$count = count($model_audio);} else {$count =0;}?>
            <input type = "hidden" value ='<?= $count?>' id="sequence_index">
            <?php
            if (!empty($model_audio)) {
                echo '2';
            }
            ?>
        </div>
    </div>
</div>