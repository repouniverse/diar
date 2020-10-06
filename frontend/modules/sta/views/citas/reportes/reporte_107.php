<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
   $query= frontend\modules\sta\models\StaResultados::find()->where(['examen_id'=>$examenesId]);
echo Html::img(Url::base().'/img/logo_cabecera.png');

?>
<div class="titulo">PLAN DE TUTORIA PSICOLOGICA INDIVIDUALIZADA (PTI)</div>
<div class="subtitulo">I DATOS DE FILIACIÓN</div>
<div class="afiliacion">
<table>
    <TR>
        <TD width="80%">
            <TABLE>
                <TR>
                    <TD>Nombres y apellidos : </TD>
                    <TD><?=$alumno->fullName()?></TD>
                </TR>
                
                <TR>
                    <TD>Código :</TD>
                    <TD><?=$alumno->codalu?></TD>
                </TR>
                <TR>
                    <TD>Facultad :</TD>
                    <TD><?=$alumno->facultad->desfac?></TD>
                </TR>
                <TR>
                   <TD>Especialidad :</TD>
                    <TD><?=$alumno->carrera->descar?></TD> 
                </TR>
                <TR>
                   <TD>Psicólogo Responsable :</TD>
                    <TD><?=$model->talleresdet->trabajador->fullName()?></TD> 
                </TR>
            </TABLE>
        </TD>
        <TD width="20%">
           </TD>
    </TR>
    
</table>
</div>
<br>
<br>
<br>
<div class="subtitulo">II INDICADORES PSICOLÓGICOS HALLADOS</div>

<div class="afiliacion">
 <?php
   
    $datos=$query->select(['puntaje_total','percentil','categoria','b.nombre','b.nemonico','b.nombre'])
            ->join('INNER JOIN','{{%sta_testindicadores}} b','indicador_id=b.id')
            ->asArray()->all();
   //echo $query->createCommand()->getRawSql();die();
    //print_r($datos[0]);
   $indicadores= array_column($datos, 'nombre');
    $percentil= array_column($datos, 'percentil');
    $percentil=array_map('intval', $percentil);
   //print_r($percentil);die();
 ?>
<diV id='migrafico' style="display:none;">
 <?php
  //HighchartsAsset::register($this)->withScripts(['/modules/exporting','/modules/offline-exporting','/modules/export-data']);

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
       'credits'=>false,
      'series' => [
          ['name' => '','pointWidth'=>15,'groupPadding'=>1,'boderRadius'=>15,'boderColor'=>'#f78ad2','color'=>'#f93087', 'data' => $percentil],
         
          
      ]
   ]
]);
    
  $string2="var chart = $('#grafiquito').highcharts();
   
var opts = chart.options;        // retrieving current options of the chart
opts = $.extend(true, {}, opts); // making a copy of the options for further modification
delete opts.chart.renderTo;      // removing the possible circular reference

/* Here we can modify the options to make the printed chart appear */
/* different from the screen one                                   */

var strOpts = JSON.stringify(opts);
//alert(strOpts);
$.post(
    'http://export.highcharts.com/',
    {
        content: 'options',
        options: strOpts ,
         type:    'image/svg+xml',
        width:   '1000px',
        scale:   '1',
        constr:  'Chart',
        async:   true
    },
    function(data){
        var imgUrl = 'http://export.highcharts.com/' + data;
        $('#miimagen').html('<img src=' +imgUrl+ '>');
        /* Here you can send the image url to your server  */
        /* to make a PDF of it.                            */
        /* The url should be valid for at least 30 seconds */
    }
);";

$this->registerJs($string2, \yii\web\View::POS_READY);  
    
    ?>
  </diV> 
    <div id='miimagen'>
       
    </div>
</diV>
<div style="width: 400px;
  margin-left: 150px;
">
    <table class="table table-condensed table-hover table-bordered table-striped">
        <thead><td colspan="3">Niveles según percentiles</td></thead>
        <thead><td>Bajo</td><td>Medio</td><td>Alto</td></thead>
        <tr><td>0-30</td><td>35-60</td><td>65-100</td></tr>
    </table>
</div>
<br>
<br>
<div class="subtitulo">III CONCLUSIONES</div>
<div class="afiliacion">
   <?=$model->getAttributeLabel('indi_altos') ?>
</div>
<div class="afiliacion italica">
   <?=$model->indi_altos ?>  
</div>
<div class="afiliacion">
   <?php echo $model->getAttributeLabel('adecuado_nivel'); ?>
</div>
<div class="afiliacion italica">
   <?=$model->adecuado_nivel?>  
</div>
<div class="afiliacion">
   <?=$model->getAttributeLabel('indi_riesgo') ?>
</div>
<div class="afiliacion italica">
   <?=$model->indi_riesgo ?>  
</div>
<div class="subtitulo">IV METAS DE TUTORIA</div>
<div class="afiliacion">
   <?=$model->getAttributeLabel('metas') ?>
</div>
<div class="afiliacion italica">
   <?=$model->metas ?>  
</div>

<div class="subtitulo">Fecha de realización del plan:</div>
<div class="afiliacion">
    <br>
</div>
<div class="subtitulo">Firma del psicólogo</div>
<br>
<br>