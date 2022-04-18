<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventGenerator */

$this->title = 'Create Event';
$this->params['breadcrumbs'][] = ['label' => 'Event Generators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-generator-create" style="background-color: lightblue; padding:5%; padding-top:2%; padding-bottom:2%;">

    <h2 class="text-center"><b><?= Html::encode($this->title) ?></b></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
