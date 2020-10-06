<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiPropietariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-propietarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'unidad_id') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'codepa') ?>

    <?= $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'edificio_id') ?>

    <?php // echo $form->field($model, 'correo1') ?>

    <?php // echo $form->field($model, 'correo2') ?>

    <?php // echo $form->field($model, 'celulares') ?>

    <?php // echo $form->field($model, 'fijo') ?>

    <?php // echo $form->field($model, 'dni') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'espropietario') ?>

    <?php // echo $form->field($model, 'participacion') ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'recibemail') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'finicio') ?>

    <?php // echo $form->field($model, 'fcese') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('base.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
