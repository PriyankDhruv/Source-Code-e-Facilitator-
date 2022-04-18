<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventGenerator */

$this->title = 'Update Event : ' . $model->event_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Generators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->event_id, 'url' => ['view', 'id' => $model->event_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-generator-update" style="background-color: lightblue; padding:5%; padding-top:2%; padding-bottom:2%;">

     <h2 class="text-center"><b><?= Html::encode($this->title) ?></b></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
