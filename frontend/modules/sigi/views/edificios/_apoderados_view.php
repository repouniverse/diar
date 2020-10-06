<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use frontend\modules\sigi\models\SigiApoderadosSearch;
?>
<div class="edificios-indexhghg">

     <div class="box-body">
         
     
    <?php Pjax::begin(['id'=>'grilla-apoderados']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'dataProvider' =>(new SigiApoderadosSearch())->searchByEdificio($model->id),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 
            'codpro',
            'clipro.despro',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    </div>
 </div>
       