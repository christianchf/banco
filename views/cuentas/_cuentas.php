<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'num_cuenta',
        'fecha_apertura',
        'saldo',
    ],
    'tableOptions' => [
        'class' => 'table table-bordered table-hover',
    ],
]) ?>
