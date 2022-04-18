<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventGeneratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Event Generator';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-generator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'event_id',
            'event_name:ntext',
            'organizer_id',
            'description:ntext',
            'event_fees',
            'credit',
            //'result_link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>