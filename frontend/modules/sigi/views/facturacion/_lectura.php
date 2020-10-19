<?php
 use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\modules\sigi\helpers\comboHelper;

use common\helpers\h;

use yii\grid\GridView;
use yii\widgets\Pjax;

use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
  use common\widgets\spinnerWidget\spinnerWidget;
    ECHO spinnerWidget::widget();
/* @var $model frontend\modules\sigi\models\SigiFacturacion */
/* @var $form yii\widgets\ActiveForm */
?>
<?php  

?>
<div class="sigi-facturacion-form">
<div class="box box-body">
    <?php 
   
    $form = ActiveForm::begin([
        'enableAjaxValidation'=>true,
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('sigi.labels', 'Continuar...'), ['class' => 'btn btn-warning']) ?>
          
            </div>
        </div>
    </div>
     


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  
  
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> comboHelper::getCboUnitsByTipoMedidor($model->edificio_id,h::session()['lecturas']['tipomedidor']),
               'campo'=>'unidad_id',
               'idcombodep'=>'sigilecturas-suministro_id',
              
                   'source'=>[\frontend\modules\sigi\models\SigiSuministros::className()=>
                                [
                                  'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'codsuministro',//columna a mostrar 
                                        'campofiltro'=>'unidad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
  
    </div>   
          
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php 
    
    echo $form->field($model, 'suministro_id')->
            dropDownList([],
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>

 </div>
  
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?php echo $form->field($model, 'lectura')->textInput() ?>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    
 </div>
  
    <?php ActiveForm::end(); ?>
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    <span class="sr-only">70% Complete</span>
  </div>
</div>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
  </div>  
   <?php
    $criteria=[
            'edificio_id'=>$model->edificio_id,
            'mes'=>$model->mes,
            'anio'=>$model->anio,
            'flectura'=>$model->SwichtFormatDate($model->flectura,'date', false),
            'facturable'=>'1',
        ];
   //ECHO \frontend\modules\sigi\models\SigiLecturas::find()->andWhere($criteria)->createCommand()->getRawSql();
   $dataProvider=new \yii\data\ActiveDataProvider([
          'query'=> \frontend\modules\sigi\models\VwSigiLecturas::find()->andWhere($criteria),
           'pagination'=>['pageSize'=>20],
         ])   ?>
   
    <?php
    $gridColumns=[
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model) {
                                    $url="";
                                    return "";
                                    return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                          
                        },
                    ]
          ],
        [ 'attribute' => 'codigo',
             'format'=>'raw',
             'value'=>function($model){
                 return $model->codigo;  
             }
             ],
                      [
               'attribute' => 'numero',
                 'value'=>function($model){
                 return $model->numero;           
                         }
                    ], 
                  [
               'attribute' => 'flectura',
                
                    ], 
               [
               'attribute' => 'suministro',
                    'value'=>function($model){
                     return $model->codsuministro;           
                        }
                    ],
                            [
               'attribute' => 'codum',
                   
                    ],
                   [
               'attribute' => 'lectura',
                   
                    ], 
        ];
                    
  ?>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    

 <?PHP  
 
     Pjax::begin(['id'=>'mislecturas','timeout'=>false]);
     
    echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
     'filename'=>'Lecturas',
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
   
      <?= GridView::widget([
        'id'=>'mygrilla',
        'dataProvider' => $dataProvider,
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
        
          
   
    <?php Pjax::end(); ?>
    </DIv>
 </DIV>
        
</div>   
  
          

    
    
    
    
    
    
</div>
    </div>