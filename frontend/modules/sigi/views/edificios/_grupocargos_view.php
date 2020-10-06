<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\sigi\models\SigiCargosgrupoedificioSearch;
?>
<div class="edificios-index_doycus">

     <div class="box-body">
         
      
    <?php Pjax::begin(['id'=>'grilla-grupocargos']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'dataProvider' =>(new SigiCargosgrupoedificioSearch())->searchByEdificio($model->id),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 
                [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                                },
                            'detail' => function ($model, $key, $index, $column) {
                            return Yii::$app->controller->renderPartial('/edificios/colectores/_colectores_view', ['grupo_id' => $model->id]);
                            },
                    //'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
                ],
            'codgrupo',
              'descripcion', [
    'attribute' => 'activo',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('activo[]', $model->activo, [ 'disabled' => true]);

             },
          ],
        ],
    ]); ?>
        
       
   
         
    <?php Pjax::end(); ?>

    </div>
      </div>