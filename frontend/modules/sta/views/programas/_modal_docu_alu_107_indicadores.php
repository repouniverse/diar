<?php

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use frontend\modules\sta\models\Citas;
if($model->cita_id >0){
 $examenesId=Citas::findOne($model->cita_id)->examenesId();
$query= frontend\modules\sta\models\StaResultados::find()->where(['examen_id'=>$examenesId]);
   
}

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?PHP
     //echo $form->field($model, 'indi_encont')->textarea();
      ?>
</div>
 <?php
   if($model->cita_id >0){
    $datos=$query->select(['puntaje_total','percentil','categoria','b.nemonico','b.nombre'])->join('INNER JOIN','{{%sta_testindicadores}} b','indicador_id=b.id')->asArray()->all();
   //echo $query->createCommand()->getRawSql();die();
    //print_r($datos[0]);
   $indicadores= array_column($datos, 'nombre');
    $percentil= array_column($datos, 'percentil');
    $percentil=array_map('intval', $percentil);
   }
   //print_r($percentil);die();
 ?>
<diV id='migrafico'>
 <?php
  //HighchartsAsset::register($this)->withScripts(['/modules/exporting','/modules/offline-exporting','/modules/export-data']);
if($model->cita_id >0){
    echo "Grafico";
     ECHO Highcharts::widget([
    'id'=>'grafiquito',
   'options' => [
       'chart'=>['type'=>'bar'],
      'title' => ['text' => 'Indicadores'],
      'xAxis' => [
         'categories' => $indicadores,
      ],
      'yAxis' => [
         'title' => ['text' => 'Percentil']
      ],
      'legend'=>['reversed'=>true],
      'plotOptions'=>[
                 'series'=>[
                    'stacking'=>'normal'
                  ],
           'bar'=>[
                'dataLabels'=>[
                   'enabled'=>true,
                   'crop'=>false,
                'overflow'=>'none'
                  // 'backgroundColor'=>'#fff'
                  ]
                ],
            ], 
       
      'series' => [
         ['name' =>'','pointWidth'=>15,'boderRadius'=>5,'boderColor'=>'#f78ad2','color'=>'#f93087', 'data' => $percentil],
         
          
      ]
   ]
]);
}  
     ?>
   
</div>
   
