<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use frontend\modules\sta\models\Citas;
//use yii\grid\GridView;
use yii\widgets\Pjax;
    use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sta\models\CitasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sta.labels', 'Resumen Asistencias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citas-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
   
    <?php  echo $this->render('_search_asistencias', ['model' => $searchModel]); ?>
         <hr/>
    
    <?php
    $gridColumns=[
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '',
                'buttons' => [
                    'update' => function($url, $model) {
                     
                          $url= \yii\helpers\Url::toRoute(['update','id'=>$model->id]);
                        $options = [
                            'data-pjax'=>'0',
                            'target'=>'_blank',
                            'title' => Yii::t('base.verbs', 'Editar'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                      
                        
                     }
                        ,
                          'view' => function($url, $model) {  
                             $url= \yii\helpers\Url::toRoute(['view','id'=>$model->id]);
                       
                              $options = [
                            'data-pjax'=>'0',
                            'target'=>'_blank',
                            'title' => Yii::t('base.verbs', 'Ver'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                      
                        
                        
                        },
                         
                    ]
                ],
                
         [ 'attribute' => 'codalu',
             //'format'=>'raw',
             //'value'=>function($model){
                // return '<span style="font-size:14px; color:#ad5eb7; font-weight:700;">'.$model->numerocita.'</span>';           
             //}
             ],
        [ 'attribute' => 'nombres',
             ],
           [ 'attribute' => 'codperiodo',
             ],
       [
           'attribute' => 'codfac',
          // 'visible' =>false,
           ],
      
         [ 'attribute' => 'codcar',
             ],
            [ 
             'attribute' => 'n_informe'
             ],
             [ 
              'attribute' => 'c_1',
             ],
               [ 
              'attribute' => 'c_2',
             ],
                  [ 
              'attribute' => 'c_3',
             ],
                  [ 
              'attribute' => 'c_4',
             ],
                                 
            
            
          
        ];
    
    echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
     'filename'=>'Citas',
     'exportConfig'=>[
         ExportMenu::FORMAT_EXCEL=>[
             'filename'=>'Exportacion'
               ],
         ExportMenu::FORMAT_EXCEL_X=>[
             'filename'=>'Exportacion'
               ]
         ],
    'columns' => $gridColumns,
    'dropdownOptions' => [
        'label' => yii::t('sta.labels','Exportar'),
        'class' => 'btn btn-success'
    ]
]) ?>
 
 <hr>
    
    
    <div style='overflow:auto;'>
    <?php Pjax::begin(['id'=>'listado_asistencias']); ?>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
        
        <div class="btn-group">
            
        </div>   
   
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
  
   