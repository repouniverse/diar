<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiTipomov */

$this->title = Yii::t('sigi.labels', 'Create Sigi Tipomov');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sigi.labels', 'Sigi Tipomovs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-tipomov-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>