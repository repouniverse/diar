<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\sigi\models\SigiEdificiodocusSearch;
?>
<div class="edificios-index_docus">

     <div class="box-body">
         
      
    <?php Pjax::begin(['id'=>'grilla-docus']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'dataProvider' =>(new SigiEdificiodocusSearch())->searchByEdificio($model->id),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 
            'codocu',
              'nombre',              
            'documento.desdocu',
                [
              'attribute' => '',
               'format'=>'raw',
                'value' => function ($model) {
                          $tieneFile= $model->countFiles();
                       IF($tieneFile>0){
                           return Html::a('<span class="btn btn-success glyphicon glyphicon-download"></span>', $model->files[0]->getUrl(), ['data-pjax'=>'0']);
                       }else{
                           return '';
                       }
                    },
                    ],
        ],
    ]); ?>
         
    <?php Pjax::end(); ?>

    </div>
      </div>