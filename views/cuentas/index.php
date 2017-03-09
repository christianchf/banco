<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'fecha_apertura:datetime',
            [
                'label' => 'Movimientos',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(
                        'Ver',
                        ['movimientos/index', 'id_cuenta' => $model->id],
                        ['class' => 'btn-sm btn-primary']
                    );
                },
                'format' => 'html',
            ],
        ],
    ]); ?>
</div>
