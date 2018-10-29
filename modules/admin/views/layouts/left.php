<?php
$items = Yii::$app->db->createCommand('SELECT * FROM menu_group WHERE position="backend" ORDER BY seq DESC')->queryAll();
foreach ($items as $item)
{
	if ($item['type']==0) 
	{
		$flag=0;
		foreach ($items as $subitem){ if ($item['id']==$subitem['type']) { $flag=1;}}
		if ($flag==1)
		{
			$menu[$item['id']]['title']="<li><a href='#'><i class='".$item['icon']."'></i><span>".Yii::t('app', $item['name'])."</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span></a>";
		}
		else
		{
			$menu[$item['id']]['title']="<li><a href='".$item['URL']."'><i class='".$item['icon']."'></i><span>".Yii::t('app', $item['name'])."</span></a>";
		}
	}
	else
	{
		$menu[$item['type']]['menu'][]="<li><a href='".Yii::$app->urlManager->createUrl($item['URL'], array('lang_id'=>\app\models\Lang::getCurrent()->id))."'><i class='".$item['icon']."'></i>  <span>".Yii::t('app', $item['name'])."</span></a></li>";
	}
}
//if (\webvimark\modules\UserManagement\models\User::hasRole('Admin'))
?>

<aside class="main-sidebar">
    <section class="sidebar">
		<ul class="sidebar-menu tree" data-widget='tree'>
			<li class="header"><span><?echo Yii::t('app', 'Backend menu');?></span></li>
			<?php
			foreach ($menu as $menu_item)
			{
				echo $menu_item['title'];
				if (!empty($menu_item['menu']))
				{
					echo "<ul class='menu-open' style='display: none;'>";
					foreach ($menu_item['menu'] as $submenu)
					{
						echo $submenu;
					}
					echo "</ul>";
				}
				echo "</li>";
			}
			?>
		</ul>
    </section>
</aside>

