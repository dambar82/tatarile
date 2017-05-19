<?php
$ar = [];
foreach ($entities as $entity) {
    $ar[] = [
        'value' => \app\components\GetEntity::getEntityTitle($entity->id)
    ];
}
echo json_encode($ar);