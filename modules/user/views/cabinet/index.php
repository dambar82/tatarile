<?php
use app\backend\models\EntityType;

$this->title = Yii::t('app','Cabinet');
$entity_type = \yii\helpers\ArrayHelper::map(EntityType::find()->all(),'id','entity_type');

if (empty($user_info->user_id)) {
  if (empty($user_info->file_name) || !file_exists(Yii::getAlias("@web/images/").$user_info->file_name)) {
    $user_info->file_name = 'default_user.png';
  }
?>

  <div class="container-fluid">
    <div class="row user_inf">
      <div class="col-xs-3 user_inf_photo">
        <img src="<?= Yii::getAlias("@web/files/avatars/").$user_info->file_name ?>">
      </div>
      <div class="col-xs-8 user_inf_cont">
        <div class="user_inf_empty">
          <?= "Поздравляем с регистрацией! Заполните пожалуйста данные о Вас <a href='".\yii\helpers\Url::to('/user/cabinet/update')."'>здесь</a>." ?>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
  if (empty($user_info->file_name) || !file_exists(Yii::getAlias("@web").'files/avatars/'.$user_info->file_name)) {
    $user_info->file_name = 'default_user.png';
  }

  /* @var $this yii\web\View */
  ?>
  <div class="main_block">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                  <h1 class="title" id="page-title"><?= $this->title; ?></h1>
              </div>
          </div>
      </div>
  </div>
    <div class="container-fluid">
      <div class="row user_inf">
          <div class="col-xs-12 col-md-10 col-lg-8 col-md-push-1 col-lg-push-2 ">
              <div class="main-content">
                  <div class="row">
                      <div class="block_h2">
                          <h2><?= Yii::t('app','User cabinet') ?></h2>
                      </div>
                      <div class="col-xs-3 user_inf_photo">
                          <img src="<?= Yii::getAlias("@web/files/avatars/").$user_info->file_name ?>" style="width: 100%; height: auto;" >
                      </div>
                      <div class="col-xs-9 user_inf_cont">
                          <div class="user_inf_name">
                              <div class="user_inf_name_cont">
                                  <?= $user_info->last_name . " " .  $user_info->first_name . " " . $user_info->middle_name; ?>
                              </div>
                          </div>
                          <div class="user_inf_bdate">
                              <div class="user_inf_bdate_cont">
                                  <label><?= Yii::t('app', 'Birthday') ?>: </label>
                                  <span><?= $user_info->birthday ?></span>
                              </div>
                          </div>
                          <?php if ($user_info->address) {?>
                              <div class="user_inf_address">
                                  <div class="user_inf_address_cont">
                                      <label><?= Yii::t('app', 'City') ?>: </label>
                                      <span><?= $user_info->address ?></span>
                                  </div>
                              </div>
                              <?php } ?>
                              <?php if ($user_info->school) {?>
                                  <div class="user_inf_school">
                                      <div class="user_inf_school_cont">
                                          <label><?= Yii::t('app', 'School') ?>: </label>
                                          <span><?= $user_info->school ?></span>
                                      </div>
                                  </div>
                                  <?php } ?>
                                  <?php if ($user_info->school_class) {?>
                                      <div class="user_inf_class">
                                          <div class="user_inf_class_cont">
                                              <label><?= Yii::t('app', 'School Class') ?>: </label>
                                              <span><?= $user_info->school_class ?></span>
                                          </div>
                                      </div>
                                      <?php } ?>
                                      <div class="user_inf_edit">
                                          <a href="<?php echo Yii::$app->urlManager->createUrl('/user/cabinet/update', array('lang_id'=>\app\models\Lang::getCurrent()->id)) ?>">
                                              <?= \Yii::t('app', 'Edit') ?>
                                          </a>
                                      </div>
                                  </div>
                              </div>

                              <?php
                              if (!empty($favorite)) {
                                  echo '<div class="row favorite_cont view_grid">';
                                      foreach ($favorite as $key=>$items) {
                                          if ($items) {
                                              echo '<div class="col-xs-12 favorite_items entity_view entity_style">';
                                              if (!empty($items[0]['title']))
                                                  echo '<div class="block_h2"><h2 class="favorite_view_title">'.Yii::t('app', 'Favorite '.strtolower($key)).'</h2></div>';
                                              echo '<div class="row">';
                                              foreach ($items as $item) {
                                                  if (!empty($item['title']))
                                                  echo $this->render('@app/views/entity/item',[
                                                  'model' => $item,
                                                  ]);
                                              }
                                              echo '</div>';
                                              echo '</div><div class="clearfix"></div>';
                                          }
                                      }
                                  echo '</div>';
                              }
                              ?>
              </div>
          </div>
    </div>


    </div>
<?php
}
?>
