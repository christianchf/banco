<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            'Crear Movimiento',
            ['create', 'id_cuenta' => $cuenta->id],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cuenta',
            'fecha_aparicion:datetime',
            'concepto',
            'importe',
        ],
    ]); ?>
</div>
