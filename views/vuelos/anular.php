<?php

/* @var $this yii\web\View */
/* @var $reserva app\models\Reservas */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\DetailView;

$this->title = 'Reserva';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $reserva,
    'attributes' => [
        'vuelo.origen.denominacion:text:Origen',
        'vuelo.destino.denominacion:text:Destino',
        'vuelo.salida:datetime',
        'vuelo.llegada:datetime',
        'vuelo.precio:currency',
        'asiento',
        'usuario.nombre:text:Usuario que reservó',
    ],
]) ?>

<?= Html::a('Confirmar anulación', '', [
    'class' => 'btn btn-danger',
    'data-method' => 'post',
]) ?>

<?= Html::a('Cancelar', ['vuelos/index'], [
    'class' => 'btn btn-warning',
]) ?>
