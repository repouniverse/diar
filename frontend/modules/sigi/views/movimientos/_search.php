<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiMovimientosPreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-movimientos-pre-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idop') ?>

    <?= $form->field($model, 'edificio_id') ?>

    <?= $form->field($model, 'cuenta_id') ?>

    <?= $form->field($model, 'fechaop') ?>

    <?php // echo $form->field($model, 'fechacre') ?>

    <?php // echo $form->field($model, 'tipomov') ?>

    <?php // echo $form->field($model, 'glosa') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'igv') ?>

    <?php // echo $form->field($model, 'monto_usd') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sigi.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sigi.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
