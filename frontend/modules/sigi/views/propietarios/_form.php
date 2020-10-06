<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiPropietarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-propietarios-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('base.labels', 'Save'), ['class' => 'btn btn-success']) ?>
          <?php 
           // $url=Url::to(['ajax-cancelado']);
            echo Html::button("<span class='fa fa-user-plus'></span>     ".Yii::t('sta.labels', 'Generar Usuario'), ['id'=>'enlaceconv_'.$model->id,'class' => 'btn btn-danger']);
            //echo Html::a(yii::t('sta.labels','Confrimar pago').'<i class="fa fa-arrow-circle-right"></i>','#', ['id'=>'enlaceconv_'.$model->id,'class'=>"small-box-footer"]);
            ?>
   

            </div>
        </div>
    </div>
      <div class="box-body">
     <?php Pjax::begin(['id'=>'pjax-cantidad']); ?>
       <?php Pjax::end(); ?>    
 <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'edificio_id')->label(yii::t('sta.labels','Unidad negocio'))->textInput(['value'=>$model->edificio->nombre,'disabled'=>true]) ?>
  

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'unidad_id')->label(yii::t('sta.labels','Unidad'))->textInput(['value'=>$model->unidad->nombre,'disabled'=>true]) ?>
  

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'tipo')->textInput(['disabled'=>true,'maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codepa')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

 </div>
  
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'correo1')->textInput(['maxlength' => true]) ?>

 </div>
 
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'celulares')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'fijo')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

 </div>
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

 </div>
  
  
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'recibemail')->checkbox([]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'activo')->checkbox([]) ?>

 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>

 </div>
  
    <?php ActiveForm::end(); ?>
 <?php 
   echo "..". buttonAjaxWidget::widget([  
            'id'=>'enlaceconv_'.$model->id,
            'idGrilla'=>'pjax-cantidad',
            'ruta'=>Url::to(['/sigi/propietarios/ajax-crea-usuario','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]); 
   ?>           
          
</div>
    </div>
