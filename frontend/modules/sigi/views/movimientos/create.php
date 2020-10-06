<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiMovimientosPre */

$this->title = Yii::t('sigi.labels', 'Create Sigi Movimientos Pre');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Sigi Movimientos Pres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-movimientos-pre-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>