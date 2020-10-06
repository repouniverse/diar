<?php
use yii\helpers\Html,yii\helpers\Url;
 //use yii\helpers\Url;
use kartik\grid\GridView;
?>
    <div style="width:300px;">
 <?php $gridColumns = [
                [  'attribute' => 'valor',
                    'label' => false, 
                        ],
                [  'attribute' => 'descripcion', 
                    'label' => false, 
                        ],
                    ];
   ?>
        <?php 
        echo GridView::widget([
            'showHeader'=> false,
             'id' => 'kv-grid-demo',
        'dataProvider' => (new \frontend\modules\sta\models\StaTestcaliSearch())->searchByTestSimple($codexamen),
         'summary' => '',
        'columns' => $gridColumns,
           
    ]);?>
    </div>
