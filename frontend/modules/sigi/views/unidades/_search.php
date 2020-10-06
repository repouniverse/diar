<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\sigi\helpers\comboHelper;
use common\helpers\h;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiUnidadesSearch */
/* @var $form yii\widgets\\ActiveForm */
?>



    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <div class="form-group">
        <?= Html::submitButton("<span class='fa fa-search'></span>     ".Yii::t('sta.labels', 'buscar'), ['class' => 'btn btn-primary']) ?>
         <?= Html::resetButton("<span class='fa fa-reply'></span>     ".Yii::t('sta.labels', 'Limpiar'), ['class' => 'btn btn-success']) ?>
       <?= Html::button("<span class='fa fa-eye'></span>     ", ['onClick'=>"$('#buscador').toggle()",  'class' => 'btn btn-success']) ?>
   
        <?= Html::a('<span class="fa fa-couch"></span>'.'    '.Yii::t('sigi.labels', 'Crear unidad'), ['create'], ['class' => 'btn btn-success']) ?>
    
    </div>
</div>
<div id="buscador">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> frontend\modules\sigi\helpers\comboHelper::getCboEdificios(),
               'campo'=>'edificio_id',
               'idcombodep'=>'sigiunidadessearch-codpro',
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
                   'source'=>[\frontend\modules\sigi\models\SigiApoderados::className()=>
                                [
                                  'campoclave'=>'codpro' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'codpro',//columna a mostrar 
                                        'campofiltro'=>'edificio_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
  
     <?php //echo cboperiodos::widget(['model'=>$model,'attribute'=>'codperiodo', 'form'=>$form]) ?>
  </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'numero') ?>
    </div>
 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'codtipo')->
            dropDownList(comboHelper::getCboTipoUnidades(),
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                        //'enableAjaxValidation' => true,
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
     <?php //echo cboperiodos::widget(['model'=>$model,'attribute'=>'codperiodo', 'form'=>$form]) ?>
  </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php
        if(count(h::request()->get()) >0){
                if(array_key_exists('edificio_id', h::request()->get()['SigiUnidadesSearch'])){
                    $edificio=h::request()->get()['SigiUnidadesSearch']['edificio_id'];
                       }else{
                    $edificio=null;
                   // $bate=null;  
                    }  
               }else{
                 $edificio=null;
                  
             }
        ?>
        
        
        <?php 
           echo $form->field($model, 'codpro')->
            dropDownList((!is_null($edificio))?comboHelper::getCboJuntas($edificio):[],
                    ['prompt'=>'--'.yii::t('base.verbs','Escoja un valor')."--",
                      ]
                    ); ?>
     
  </div>
    
    
    
</div>
    

    <?php ActiveForm::end(); ?>

