<?php
if(!$pagination) {
?>

<div class="container-fluid">
    <div class="row">
    <div class="col-md-3 col-lg-3 col-md-not-padding white-bg-sidebar"></div>
    <div class="col-md-3 col-lg-3 col-md-not-padding left-sidebar">
        <div class="sidebar-content">
            <form method="get" id="filter" class="filter-serializer" data-filter-page="1">
                <div class="hidden-md hidden-lg filter-config">
                    <div class="filter-config-cont">
                        <a class="filter-config-btn" href="javascipt://"></a>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm sidebar_filter_title">
                    <span><?=Yii::t('app','Library')?></span>
                </div>
                <div class="sidebar_row_content">
                    <div class="filter_field filter_razdel">
                        <div class="filter_title"><label for="filter_razdel"><?=Yii::t('app','Section')?></label></div>
                        <div class="field_items">
                        
                            <?php
                              foreach ($parentSubjects as $parentSubjectID => $parentSubjectTitle) {
                                  ?>
                                    <div class="field_item radio"> <!-- radio, radio-2 -->
                                        <label for="category_<?= $parentSubjectID ?>">
                                            <input type="radio" id="category_<?= $parentSubjectID ?>" name="category_id" value="<?=$parentSubjectID?>" class="hidden"<?php if($category_id == $parentSubjectID) echo ' checked';?>>
                                            <span><?=$parentSubjectTitle?></span>
                                        </label>
                                    </div>
                                    
                                  <?php
                              }
                              ?>




                            <select class="form-control updater-select" name="category_id" style="display: none;">
                              <option value="0"<?php if($category_id == 0) echo ' selected';?>><?=Yii::t('app','Choose section')?></option>
                              <?php
                              foreach ($parentSubjects as $parentSubjectID => $parentSubjectTitle) {
                                  ?>
                                    <option value="<?=$parentSubjectID?>"<?php if($category_id == $parentSubjectID) echo ' selected';?>><?=$parentSubjectTitle?></option>
                                  <?php
                              }
                              ?>
                            </select>
                            <select class="form-control" id="category_id">
                                <option value="0"<?php if($category_id == 0) echo ' selected';?>><?=Yii::t('app','Choose section')?></option>
                                <?php
                                foreach ($parentSubjects as $parentSubjectID => $parentSubjectTitle) {
                                    ?>
                                    <option value="<?=$parentSubjectID?>"<?php if($category_id == $parentSubjectID) echo ' selected';?>><?=$parentSubjectTitle?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    if(count($subcats) > 0) {
                        ?>
                        <div class="filter_field filter_temi">
                            <div class="filter_title"><label for="filter_temi"><?=Yii::t('app','Subject')?></label></div>
                            <div class="field_items">
                                <?php
                                foreach ($subcats as $subcatID => $subcatTitle) {
                                    ?>
                                    <div class="field_item checkbox">
                                        <label>
                                            <input type="checkbox" id="type-<?=$subcatID?>" name="subcategories[<?=$subcatID?>]" value="1" <?php if(isset($selectedSubcat[$subcatID])) echo 'checked';?>>
                                            <span><?=$subcatTitle?></span></label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    if(count($entity_types) > 1) {
                        ?>
                        <div class="filter_field filter_type">
                            <div class="filter_white_round"></div>
                            <div class="filter_theme_round"></div>
                            <div class="filter_title"><label for="filter_type"><?=Yii::t('app','Content type')?></label></div>
                            <div class="field_items">
                                <?php
                                foreach ($entity_types as $entity_type) {
                                    ?>
                                    <div class="field_item checkbox checkbox_<?= $entity_type->entity_type ?>">
                                        <label>
                                            <input type="checkbox" id="type-<?= $entity_type->id ?>"
                                                   name="entity_type[<?= $entity_type->id ?>]"
                                                   value="1" <?php if (isset($selected_types[$entity_type->id])) echo 'checked'; ?>>
                                            <span><?= Yii::t('app', $entity_type->entity_type) ?></span></label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
            <div class="hidden-xs hidden-sm hidden-lg right-sidebar">
                <?=$this->render('search-right-block',[
                    'type' => $type,
                    'entitiesPop' => $entitiesPop
                ])?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php

if (!empty($entities)) {
    if(!$pagination)  {
    ?>
        <div class="search-page col-md-9 col-lg-6" id="search-page">
            <div class="row hidden-md hidden-lg mobile-block-btns">
                <div class="hidden-md hidden-lg filter-config">
                    <div class="filter-config-cont">
                        <a class="filter-config-btn" href="javascipt://"></a>
                    </div>
                </div>
                <div class="hidden-md hidden-lg alphabet-config">
                    <div class="alphabet-config-cont">
                        <a class="alphabet-config-btn" href="javascipt://"></a>
                    </div>
                </div>
            </div>
            <div class="row alphabet-filter-block">
                <?=$this->render('alphabet-filter',[
                        'char' => $char
                ])?>
                <div class="hidden-md hidden-lg alphabet-config">
                    <div class="alphabet-config-cont">
                        <a class="alphabet-config-btn" href="javascipt://"></a>
                    </div>
                </div>
            </div>
            <div class="row date-slider-block">
                <div class="date-slider-block-cont">
                    <div class="TriSea-technologies-Switch switch_date">
                        <input id="TriSeaDefault" name="TriSea1" type="checkbox"<?php if($dateFilter) echo ' checked="checked"'?>/>
                        <label for="TriSeaDefault" class="label-default"></label>
                    </div>
                    <form id="filter-date" class="filter-serializer<?php if(!$dateFilter) echo ' ignored'?>">
                        <div class="filter_field filter_date_content">
                            <div class="field_date_start">1050 <span>до н.э.</span></div>
                            <div class="field_date_end">1050</div>
                            <div class="field_items">
                                <div class="input-group">
                                    <!--span class="input-group-addon">От</span-->
                                    <input type="text" class="form-control hidden" name="date-start" id="date-start" maxlength="10" value="<?=$dateStart?>">
                                </div>
                                <div class="input-group">
                                    <!--span class="input-group-addon">До</span-->
                                    <input type="text" class="form-control hidden" name="date-end" id="date-end" maxlength="10" value="<?=$dateEnd?>">
                                </div>
                                <div id="slider_date"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row contents_view">
                <?=$this->render('popular-filter',[
                    'popular' => $popular
                ])?>
                <div class="contents_view_wrap">
                    <a href="javascript://" onclick="View('grid')">
                        <div class="view_grid_btn view_btn">
                            <span><?= Yii::t('app','Bar'); ?></span>
                        </div>
                    </a>
                    <a href="javascript://" onclick="View('table')">
                        <div class="view_table_btn view_btn">
                            <span><?= Yii::t('app','List'); ?></span>
                        </div>
                    </a>
                </div>
            </div>
        <div class="row entity_view">
    <?php
    }
    ?>


<?php
for ($i = 0;$i<count($entities) && $i<$limit; $i++) {
    echo $this->render('entity',[
        'model' => $entities[$i],
        'parentSubjects' => $parentSubjects
    ]);
};?>

<?php

if(count($entities) > $limit) echo '<div class="load_more"><button class="btn" id="load-entities">'.Yii::t('app','Load more').'</button></div>';
if(!$pagination) {
    ?>
        </div>
        </div>
        <div class="col-md-3 col-lg-3 hidden-md col-md-not-padding right-sidebar">
            <div class="sidebar-content">
                <?=$this->render('search-right-block',[
                    'type' => $type,
                    'entitiesPop' => $entitiesPop
                ])?>
            </div>
        </div>
        </div>
</div>
<?php }
?>
<?php }
elseif(!$pagination) { ?>
    <div class="search-page col-md-9 col-lg-6" id="search-page">
        <div class="row hidden-md hidden-lg mobile-block-btns">
            <div class="hidden-md hidden-lg filter-config">
                <div class="filter-config-cont">
                    <a class="filter-config-btn" href="javascipt://"></a>
                </div>
            </div>
            <div class="hidden-md hidden-lg alphabet-config">
                <div class="alphabet-config-cont">
                    <a class="alphabet-config-btn" href="javascipt://"></a>
                </div>
            </div>
        </div>
        <div class="row alphabet-filter-block">
            <?=$this->render('alphabet-filter',[
                    'char' => $char
            ])?>
        </div>
        <div class="row date-slider-block">
            <div class="date-slider-block-cont">
                <div class="TriSea-technologies-Switch switch_date">
                    <input id="TriSeaDefault" name="TriSea1" type="checkbox"<?php if($dateFilter) echo ' checked="checked"'?>/>
                    <label for="TriSeaDefault" class="label-default"></label>
                </div>
                <form id="filter-date" class="filter-serializer<?php if(!$dateFilter) echo ' ignored'?>">
                    <div class="filter_field filter_date_content">
                        <div class="field_date_start">1050 <span>до н.э.</span></div>
                        <div class="field_date_end">1050</div>
                        <div class="field_items">
                            <div class="input-group">
                                <!--span class="input-group-addon">От</span-->
                                <input type="text" class="form-control hidden" name="date-start" id="date-start" maxlength="10" value="<?=$dateStart?>">
                            </div>
                            <div class="input-group">
                                <!--span class="input-group-addon">До</span-->
                                <input type="text" class="form-control hidden" name="date-end" id="date-end" maxlength="10" value="<?=$dateEnd?>">
                            </div>
                            <div id="slider_date"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row contents_view">
            <?=$this->render('popular-filter',[
                'popular' => $popular
            ])?>
            <div class="contents_view_wrap">
                <a href="javascript://" onclick="View('grid')">
                    <div class="view_grid_btn view_btn">
                        <span><?= Yii::t('app','Bar'); ?></span>
                    </div>
                </a>
                <a href="javascript://" onclick="View('table')">
                    <div class="view_table_btn view_btn">
                        <span><?= Yii::t('app','List'); ?></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="empty-data">Нет данных</div>
    </div>
    <div class="col-md-3 col-lg-3 hidden-md col-md-not-padding right-sidebar">
        <div class="sidebar-content">
            <?=$this->render('search-right-block',[
                'type' => $type,
                'entitiesPop' => $entitiesPop
            ])?>
        </div>
    </div>
    </div>
    </div>
<?php }
?>
