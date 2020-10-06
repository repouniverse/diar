<?php
use common\components\CalendarScheduleWidget;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\h;
use yii\grid\GridView;
use yii\widgets\Pjax;

use frontend\modules\sta\staModule;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="borereuccess">   
  <div class="box box-body">               
<?php
  IF(staModule::getCurrentPeriod()==$codperiodo){?>
      <div class="alert alert-info"><span class="fa fa-book-reader"></span><?='    '.h::user()->profile->trabajador->fullName()?></div>
     
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4><?='   '.yii::t('sta.labels','Citas programadas para hoy')?></h4>
         <?= GridView::widget([
        'dataProvider' => $provider,
        // 'summary' => '',
         'tableOptions'=>[
             'class'=>'table table-condensed table-hover table-borderless table-striped table-responsive text-nowrap'
             ],
             'columns' => [
                 'numerocita',
         [
             'attribute'=>'Cita',
             'format'=>'raw',
              'value'=>function($model){
                $url=Url::to(['/sta/citas/update','id'=>$model->id]);
                $options=['data-pjax'=>'0','target'=>'_blank'];
                 return Html::a(substr($model->fechaprog,0,16),$url,$options);
              }
                
                ],
           [
             'attribute'=>'nombreprograma',
             'format'=>'raw',
              'value'=>function($model){
                $url=Url::to(['/sta/programas/update','id'=>$model->talleres_id]);
                $options=['data-pjax'=>'0','target'=>'_blank'];
                 return Html::a(substr($model->nombreprograma,0,15).'...',$url,$options);
              }
                
                ],
             'codalu', 
                  'ap',
            'nombres',
            [
             'attribute'=>'Imagen',
             'format'=>'html',
              'value'=>function($model){
                 return $model->fotoAluSmall();
              }
                
                ]
        ],
    ]); ?>
     </div> 
    
          
      
      
        
            
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <h4><?= yii::t('sta.labels','Citas programadas en general')?></h4>
 <?PHP     
$jsRemoveCallback = <<<JS
function(title) {
  console.log('removeCallback', title);
}
JS;

$jsCreateCallback = <<<JS
function(title, color) {
  console.log('createCallback', title, color);
}
JS;
echo CalendarScheduleWidget::widget([
    'defaultEventDuration'=>'00:45',
     
    'draggableEvents' => [
        'visible'=>false,
        'items' => [],
       
    ],
    'createEvents' => [
         'visible'=>false,
        'colors' => [],
       
    ],
    'fullCalendarOptions' => [
        'editable' => false,
       /*  'validRange'=>[
                'start'=>'2019-11-05',
                'end'=>'2019-11-19'
                ],*/
        //'formatDate'=>'dd/mm/yyyy',
         'locale'=>'es',
        
       'events' => $citasPendientes,
        'eventClick' => new JsExpression('function(event) {
          var url = "sta/citas/update?id="+event.id;
          var abso="'.\yii\helpers\Url::home(true).'";
              window.open(abso+url);
         }' ),
    ]
]);?>
 </div>  
<?PHP
  }ELSE{ ?>
    <div class="alert alert-info"><span class="fa fa-book-reader"></span><?='    '.yii::t('sta.labels','La programación de citas sólo es posible en el periodo activo  '.staModule::getCurrentPeriod())?></div>  
 <?PHP }

?>
    
        
</div>
    </div>
