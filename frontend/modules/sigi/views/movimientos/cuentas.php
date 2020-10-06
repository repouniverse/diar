<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
  use common\widgets\spinnerWidget\spinnerWidget;
    ECHO spinnerWidget::widget();
$this->title = Yii::t('sigi.labels', 'Cuentas Bancarias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-porpagar-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    

    
    <div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url,$model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'), 
                            'data-pjax'=>'0'
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', Url::to(['edita-cuenta','id'=>$model->id]), $options/*$options*/);
                         },
                          
                    ]
                ],
            
            
         [    'attribute'=>'edificio_id',
               'filter'=> frontend\modules\sigi\helpers\comboHelper::getCboEdificios(),
               'value'=>function($model){
                        return $model->edificio->nombre;
               }
               ],

           [    'attribute'=>'nombre',
               'value'=>function($model){
                        return $model->nombre;
               }
               ],
           [    'attribute'=>'numero',
               'value'=>function($model){
                        return $model->numero;
               }
               ],
            [    'attribute'=>'codmon',
               'value'=>function($model){
                        return $model->codmon;
               }
               ],
             
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
       