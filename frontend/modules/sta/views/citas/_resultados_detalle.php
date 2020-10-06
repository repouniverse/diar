<?php
use miloschuman\highcharts\Highcharts;


 use yii\widgets\Pjax;
 use yii\grid\GridView;
 use yii\helpers\Html;
  use yii\helpers\Url;

?>
     <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
            <div class="row">
               <div class="btn-group">
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
         <?=($model->asistio )?\yii\helpers\Html::button('<span class="fa fa-industry"></span>   '.Yii::t('sta.labels', 'Procesar'), ['id'=>'boton_procesa','class' => 'btn btn-success']):''?>  
             </div>
                </div>
            </div>
        </div>
    </div> 
    
   <?php Pjax::begin(['id'=>'grilla-resultados']); ?>
    
   <?php 
  
   $query= frontend\modules\sta\models\StaResultados::find()->where(['examen_id'=>$model->examenesId($idCitaEvalInicial)]);
$provider= new \yii\data\ActiveDataProvider([
            'query'=>$query,
        ]);
//var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'id'=>'grid-resultados',
        'dataProvider' =>$provider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 'puntaje_total' ,
                 'percentil',
            ['attribute'=>'',
                'format'=>'raw',
                     'value'=>function($model){
                        return '<i style="color:'.$model->color().'"><span class="fa fa-circle"></span></i>';
                        }
                     ],
                 'indicador.nombre',
                 'categoria',
            
                /* ['attribute'=>'interpretacion',
                     'value'=>function($model){
                        return substr($model->interpretacion,0,60).'...';
                        }
                     ]*/
               ],
    ]); ?>
    
   
    
       <?php Pjax::end(); ?> 
 
    
<?php
$string4="$('#boton_procesa').on( 'click', function(){ 
     
     
       $.ajax({
              url: '".Url::to(['/sta/citas/resultados','id'=>$model->id])."', 
              type: 'get',
              data:{id:".$model->id."},
              dataType: 'json', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
              var n = Noty('id');
                      
                       if ( !(typeof json['error']==='undefined') ) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                          }    

                             if ( !(typeof json['warning']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['warning']);
                              $.noty.setType(n.options.id, 'warning');  
                             } 
                          if ( !(typeof json['success']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['success']);
                              $.noty.setType(n.options.id, 'success');  
                             }      
                   
                        }
                        });


             })";
  $this->registerJs($string4, \yii\web\View::POS_END);
?>
    
    <?php
   
    $datos=$query->select(['puntaje_total','percentil','categoria','b.nemonico','b.nombre'])->join('INNER JOIN','{{%sta_testindicadores}} b','indicador_id=b.id')->asArray()->all();
   //echo $query->createCommand()->getRawSql();die();
    //print_r($datos[0]);
   $indicadores= array_column($datos, 'nemonico');
    $percentil= array_column($datos, 'percentil');
    $percentil=array_map('intval', $percentil);
   //print_r($percentil);die();
    echo Highcharts::widget([
   'options' => [
       'chart'=>['type'=>'bar'],
      'title' => ['text' => 'Indicadores'],
      'xAxis' => [
         'categories' => $indicadores,
      ],
      'yAxis' => [
         'title' => ['text' => 'Percentil']
      ],
      //'legend'=>['reversed'=>true],
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
         ['name' => $model->numero,'pointWidth'=>15,'groupPadding'=>1,'boderRadius'=>15,'boderColor'=>'#f78ad2','color'=>'#f93087', 'data' => $percentil],
         
          
      ]
   ]
]);
    
    
    ?>
  
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
