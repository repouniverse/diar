<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiKardexdepa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-kardexdepa-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
          <?php 
           // $url=Url::to(['ajax-cancelado']);
            echo Html::button("<span class='fa fa-money'></span>     ".Yii::t('sta.labels', 'Confirmar pago'), ['id'=>'enlaceconv_'.$model->id,'class' => 'btn btn-danger']);
            //echo Html::a(yii::t('sta.labels','Confrimar pago').'<i class="fa fa-arrow-circle-right"></i>','#', ['id'=>'enlaceconv_'.$model->id,'class'=>"small-box-footer"]);
            ?>


            </div>
        </div>
    </div>
      <div class="box-body">
        <?php Pjax::begin(['id'=>'pjax-cantidad']); 
        echo "Monto cobrado total : <i style='font-weight:800;color:purple'>".Yii::$app->formatter->format($model->facturacion->montoCobrado(), 'decimal')."</i>  de   <i style='font-weight:800;color:purple'>".Yii::$app->formatter->format($model->facturacion->montoFacturado(),'decimal').'</i>';
               ?>
            <div class="progress">
                <?php 
                 $porcentajeCobranza=$model->facturacion->porcentajeCobranza();  ?>
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?=$porcentajeCobranza?>%" aria-valuenow="<?=$porcentajeCobranza?>" aria-valuemin="0" aria-valuemax="100">AVANCE DE COBRANZA  <?=$porcentajeCobranza?>%</div>
            </div>
           <?php Pjax::end();  ?> 
 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'facturacion_id')->label(yii::t('sta.labels','Facturación'))->textInput(['value'=>$model->facturacion->descripcion,'disabled'=>true]) ?>
  </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'edificio_id')->label(yii::t('sta.labels','Unidad negocio'))->textInput(['value'=>$model->edificio->nombre,'disabled'=>true]) ?>
  

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'unidad_id')->label(yii::t('sta.labels','Unidad'))->textInput(['value'=>$model->unidad->nombre,'disabled'=>true]) ?>
  

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'edificio_id')->textInput() ?>

 </div>
  
 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
 <?= $form->field($model, 'mes')->
            dropDownList(\common\helpers\timeHelper::cboMeses(),
                  ['prompt'=>'--'.yii::t('base.verbs','Seleccione un Valor')."--",
                    // 'class'=>'probandoSelect2',
                    'disabled'=>true,
                        ]
                    ) ?>
 </div> 
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'fecha')->textInput(['maxlength' => true,'disabled'=>true,]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'anio')->textInput(['maxlength' => true,'disabled'=>true,]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codmon')->textInput(['maxlength' => true,'disabled'=>true,]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'numerorecibo')->textInput(['value'=>$model->numeroReciboConsultado(),'disabled'=>true,'maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'montoNominal')->label('Monto a cobrar')->textInput(['value'=>$model->montoCalculado(),'disabled'=>true,'maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'monto')->label('Monto depositado')->textInput(['maxlength' => true]) ?>

 </div>        
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'igv')->textInput(['maxlength' => true,'disabled'=>true,]) ?>

 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textarea(['rows' => 6]) ?>

 </div>
     
    <?php ActiveForm::end(); ?>
          
          
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <?= \common\widgets\imagewidget\ImageWidget::widget([
        'name'=>'imagenrep',
        'isImage'=>false,  
        'model'=>$model,
        'extensions'=>['pdf','doc','docx','png','jpg'],
            ]); ?>
   </div> 
 
<?=(!$model->isNewRecord)? \nemmo\attachments\components\AttachmentsTable::widget([
	'model' => $model,
	//'showDeleteButton' => false, // Optional. Default value is true
]):''?>      
          
          
          
          
  <?php 
   echo "..". buttonAjaxWidget::widget([  
            'id'=>'enlaceconv_'.$model->id,
            'idGrilla'=>'pjax-cantidad',
            'ruta'=>Url::to(['ajax-cancelado','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]); 
   ?>           
          
          

</div>
    </div>
