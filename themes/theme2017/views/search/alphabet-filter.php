<form id="alphabet-filter" class="filter-serializer">
    <?php
    $alphabet = Yii::t('app','alphabet');
    foreach ($alphabet as $symbol) {
    ?>
        <div class="checkbox pull-left margin0">
            <label>
                <input type="checkbox" data-char="<?=$symbol?>" <?php if($symbol == $char) echo ' checked';?>> <span><?=mb_strtoupper($symbol)?></span>
            </label>
        </div>
    <?php
    }
    ?>
</form>
