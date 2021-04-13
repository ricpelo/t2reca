<?php

/* @var $this yii\web\View */
/* @var $vuelo app\models\Vuelos */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\DetailView;

$this->title = 'Vuelos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $vuelo,
    'attributes' => [
        'origen.denominacion:text:Origen',
        'destino.denominacion:text:Destino',
        'salida:datetime',
        'llegada:datetime',
        'plazas',
        'precio:currency',
        'plazasLibres',
    ],
]) ?>

<?php if ($reservas->hasErrors()): ?>
    <div>
        <p>Se han producido los siguientes errores:</p>
    </div>
    <ul style="color:red">
        <?php foreach ($reservas->getErrors() as $error): ?>
            <li><?= $error[0] ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($reservas, 'asiento')->dropdownList($vuelo->asientosLibres()) ?>

    <div class="form-group">
        <?= Html::submitButton('Reservar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['vuelos/index'], [
            'class' => 'btn btn-warning',
        ]) ?>
    </div>
<?php ActiveForm::end() ?>
