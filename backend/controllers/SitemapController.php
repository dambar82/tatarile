<?php

namespace app\backend\controllers;

use app\backend\models\Entity;
use app\components\Sitemap;
use yii\helpers\Url;
use yii\web\Controller;


class SitemapController extends Controller
{
    public function actionIndex()
    {

        $sitemap = new Sitemap();
        $item = [];

//        $item = [
//            ['loc' => Url::base(true), 'changefreq' => 'weekly', 'priority' => 0.5],
//            ['loc' => Url::base(true).'/author', 'changefreq' => 'weekly', 'priority' => 0.5],
//            ['loc' => Url::base(true).'/about', 'changefreq' => 'weekly', 'priority' => 0.5],
//        ];

        $query = Entity::find()->where(['entity.status'=>1]);

        $entities = $query
            ->innerJoin('entity_property AS entity_property_title',"`entity_property_title`.`entity_type_id` = `entity`.`entity_type_id` AND `entity_property_title`.`name`= 'title'")
            ->innerJoin('entity_property AS entity_property_annot',"`entity_property_annot`.`entity_type_id` = `entity`.`entity_type_id` AND `entity_property_annot`.`name`= 'annotation'")
            ->all();

        foreach ($entities as $ent) {
            $loc = Url::base(true).'/encyclopedia/'.$ent->slug;
            $item[] = ['loc' => $loc, 'changefreq' => 'weekly', 'priority' => 0.5];
        }

        $sitemap->add($item);
        $sitemap->render();
        return true;


    }
}
