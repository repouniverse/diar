<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="sigi-porpagar-index">

   
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    

    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query'=>$model->getProgramaPagos(),
        ]),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         
                    ]
                ],
         
         
         
         
         

           [    'attribute'=>'Documento',
               'value'=>function($model){
                        return $model->fechaprog;
               }
               ],
          
           
          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
       