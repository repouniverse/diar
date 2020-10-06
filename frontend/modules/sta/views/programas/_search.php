<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\TalleresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talleres-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codfac') ?>

    <?= $form->field($model, 'codtra') ?>

    <?= $form->field($model, 'codtra_psico') ?>

    <?= $form->field($model, 'fopen') ?>

    <?php // echo $form->field($model, 'fclose') ?>

    <?php // echo $form->field($model, 'codcur') ?>

    <?php // echo $form->field($model, 'activa') ?>

    <?php // echo $form->field($model, 'codperiodo') ?>

    <?php // echo $form->field($model, 'electivo') ?>

    <?php // echo $form->field($model, 'ciclo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sta.labels', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sta.labels', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
