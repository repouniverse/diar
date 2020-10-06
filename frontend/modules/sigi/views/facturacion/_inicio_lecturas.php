<?php
 use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\modules\sigi\helpers\comboHelper;
use common\helpers\timeHelper;
use common\helpers\h;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\sigi\models\SigiSuministros;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\selectwidget\selectWidget;

/* @var $model frontend\modules\sigi\models\SigiFacturacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-facturacion-form">
<div class="box box-body">
    <?php $form = ActiveForm::begin([
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
      <div class="box-body">

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php echo $form->field($model, 'edificio_id')->
            dropDownList(comboHelper::getCboEdificios(),
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>

 </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <?= $form->field($model, 'flectura')->widget(DatePicker::class, [
                            'language' => h::app()->language,
                           'pluginOptions'=>[
                                     'format' => h::getFormatShowDate()  , 
                                   'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>'2014:'.date('Y'),
                               ],
                          
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
 </div>       
          
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php echo $form->field($model, 'mes')->
            dropDownList(timeHelper::cboMeses(),
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>

 </div>
  
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?php echo $form->field($model, 'anio')->
            dropDownList(timeHelper::cboAnnos(),
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
  
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     
    <?php 
    echo Html::label(yii::t('sigi.labels','Tipo'), 'codtipo', ['class'=>'control-label']);
    echo Html::dropDownList('codtipo',
            SigiSuministros::COD_TYPE_SUMINISTRO_DEFAULT,
           SigiSuministros::comboDataField('tipo'),
             ['class'=>'form-control',
               'prompt'=>'--'.yii::t('base.verbs','Seleccione un valor')."--"]);
    ?>
       
    
 </div>    
 
 

          
    <?php ActiveForm::end(); ?>
          
 </div>      
</div>
    </div>