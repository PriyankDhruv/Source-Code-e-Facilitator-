<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EventGenerator */

$this->title = $model->event_name;
if($model->organizer_id == 'organizer_id'){
    
    $this->params['breadcrumbs'][] = ['label' => 'Event Generator', 'url' => ['index']];
    
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-generator-view" >

    <h2 class="text-center"><b><?= Html::encode($this->title) ?></b></h2>

    <?php
    
        if($model->organizer_id == 'organizer_id'){
            
    ?>
    
    <p>
        
        <?= Html::a('Update', ['update', 'id' => $model->event_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->event_id], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?php
        
        }
    ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_name:ntext',
            'organizer_id',
            'description:ntext',
            'event_fees',
            'credit',
            'result_link',
        ],
    ]) ?>
    
</div>
