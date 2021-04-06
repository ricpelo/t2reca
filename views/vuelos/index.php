<?php

use app\models\Vuelos;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VuelosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vuelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vuelos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'origen.denominacion:text:Origen',
            'destino.denominacion:text:Destino',
            'salida:datetime',
            'llegada:datetime',
            'plazas',
            'precio:currency',
            'plazasLibres',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{reservar} {anular}',
                'buttons' => [
                    'reservar' => function ($url, Vuelos $model, $key) {
                        if (!$model->tieneReserva()) {
                            return Html::a('Reservar', [
                                'vuelos/reservar',
                                'id' => $model->id
                            ], ['class' => 'btn-sm btn-info']);
                        }
                    },
                    'anular' => function ($url, Vuelos $model, $key) {
                        if ($model->tieneReserva()) {
                            return Html::a('Anular', [
                                'vuelos/anular',
                                'id' => $model->id
                            ], ['class' => 'btn-sm btn-info']);
                        }
                    }
                ],
            ],
        ],
    ]); ?>


</div>
