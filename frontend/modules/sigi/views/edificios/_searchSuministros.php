<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\sigi\models\SigiSuministros;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\EdificiosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

  

    <?php $form = ActiveForm::begin([
       
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
   <div class="form-group">
        <?= Html::submitButton("<span class='fa fa-search'></span>     ".Yii::t('sta.labels', 'buscar'), ['class' => 'btn btn-primary']) ?>
        
    </div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
 <?php 
 
  echo $form->field($model, 'tipo')->
            dropDownList(SigiSuministros::comboDataField('tipo'),
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un Valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                       //'disabled'=>($model->isNewRecord)?'disabled':null,
                      ]
                    );   
 
 ?>
    </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  
  
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> frontend\modules\sigi\helpers\comboHelper::getCboEdificios(),
               'campo'=>'edificio_id',
               'idcombodep'=>'sigisuministrossearch-unidad_id',
               /* 'source'=>[ //fuente de donde se sacarn lso datos 
                    /*Si quiere colocar los datos directamente 
                     * para llenar el combo aqui , hagalo coloque la matriz de los datos
                     * aqui:  'id1'=>'valor1', 
                     *        'id2'=>'valor2,
                     *         'id3'=>'valor3,
                     *        ...
                     * En otro caso 
                     * de la BD mediante un modelo  
                     */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'codenvio'/* //cpolumna 
                                         * columna que sirve como criterio para filtrar los datos 
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *
                        
                         ]*/
                   'source'=>[\frontend\modules\sigi\models\SigiUnidades::className()=>
                                [
                                  'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombre',//columna a mostrar 
                                        'campofiltro'=>'edificio_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
  
    </div> 
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<?php 
echo $form->field($model, 'unidad_id')->
            dropDownList([],
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un Valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>  
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'codsuministro')->textInput()
           ?>
     <?php //echo cboperiodos::widget(['model'=>$model,'attribute'=>'codperiodo', 'form'=>$form]) ?>
  </div> 

    <?php ActiveForm::end(); ?>







