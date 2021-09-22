<?php

use yii\helpers\Html;
use yii\grid\GridView;
use core\entities\user\User;
use kartik\widgets\DatePicker;
use core\helpers\UserHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'value' => function (User $model) {
                    return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'email:email',
            /*[
                'attribute' => 'role',
                'class' => RoleColumn::class,
                'filter' => $searchModel->rolesList(),
            ],*/
            [
                'attribute' => 'status',
                'filter' => UserHelper::statusList(),
                'value' => function (User $model) {
                    return UserHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
                'format' => 'datetime',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
