<div class="admin-default-index">


    <?php
    if(isset($adminMessagesDataProvider))
    echo \yii\grid\GridView::widget([
        'dataProvider' => $adminMessagesDataProvider,
        'columns' => [
            'name',
            'subject',
            'body',
            [
                'attribute' => 'date_create',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
                'format'=>'text',
                'content'=>function($data){
                    if($data->status == 1)
                        return 'new';
                    else
                        return 'viewed';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn'
            ]
        ]
    ]);
    ?>
</div>
