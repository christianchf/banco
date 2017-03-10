<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$this->title = 'Buscador de cuentas';
$this->params['breadcrumbs'][] = $this->title;
$url = Url::to(['cuentas/cuentas']);
$urlActual = Url::to(['cuentas/buscar']);
$js = <<<EOT
    $('#cuentaform-num_cuenta').keyup(function(){
        var q = $('#cuentaform-num_cuenta').val();
        if (q == '') {
            $('#cuentas').html('');
        }
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {
                q: q
            },
            success: function (data, status, event) {
                $('#cuentas').html(data);
            }
        });
    });
EOT;
$this->registerJs($js);
?>
 <div class="cuentas-buscar">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['cuentas/buscar'],
    ]); ?>
        <?= $form->field($model, 'num_cuenta') ?>
        <div class="form-group">
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- alquileres-alquilar -->
<div id="cuentas">
</div>
