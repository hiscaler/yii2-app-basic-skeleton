<?php

use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LookupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '基本设置';
$this->params['breadcrumbs'][] = $this->title;
$this->params['menus'] = [
    ['label' => Yii::t('app', 'List'), 'url' => ['index']],
    ['label' => Yii::t('app', 'Create'), 'url' => ['create']],
    ['label' => Yii::t('app', 'Grid Column Config'), 'url' => ['grid-column-configs/index', 'name' => 'common-models-Lookup'], 'htmlOptions' => ['class' => 'grid-column-config', 'data-reload-object' => 'grid-view-lookups']],
    ['label' => Yii::t('app', 'Search'), 'url' => '#'],
];
?>

<div class="row">
    <div class="col-md-12 template-index">
        <div class="box">
            <div class="box-body">

                <?= $this->render('_search', ['model' => $searchModel]); ?>

                <?php
                Pjax::begin([
                    'formSelector' => '#form-lookups',
                    'linkSelector' => '#grid-view-lookups a',
                ]);
                echo GridView::widget([
                    'id' => 'grid-view-lookups',
//        'name' => 'common-models-Lookup',
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['class' => 'serial-number']
                        ],
                        [
                            'attribute' => 'label',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return \yii\helpers\Html::a($model['label'], ['update', 'id' => $model['id']]);
                            },
                                'headerOptions' => ['class' => 'lookup-label'],
                            ],
                            'description',
                            [
                                'attribute' => 'value',
                                'value' => function($model) {
                                    return StringHelper::truncate($model['value'], 20);
                                }
                            ],
                            [
                                'attribute' => 'return_type',
                                'format' => 'lookupReturnType',
                                'headerOptions' => ['class' => 'lookup-return-type center'],
                            ],
                            [
                                'attribute' => 'enabled',
                                'format' => 'boolean',
                                'headerOptions' => ['class' => 'boolean pointer lookup-enabled-handler'],
                            ],
                            [
                                'attribute' => 'created_by',
                                'value' => function($model) {
                                    return $model['creater']['nickname'];
                                },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'date',
                                'headerOptions' => ['class' => 'date']
                            ],
                            [
                                'attribute' => 'updated_by',
                                'value' => function($model) {
                                    return $model['updater']['nickname'];
                                },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => 'date',
                                'headerOptions' => ['class' => 'date']
                            ],
                            [
                                'attribute' => 'deleted_by',
                                'value' => function($model) {
                                    return $model['deleter']['nickname'];
                                },
                                'headerOptions' => ['class' => 'username']
                            ],
                            [
                                'attribute' => 'deleted_at',
                                'format' => 'date',
                                'headerOptions' => ['class' => 'date']
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'headerOptions' => ['class' => 'btns-3'],
                            ],
                        ],
                    ]);
                    Pjax::end();
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    $this->registerJs('yadjet.actions.toggle("table td.lookup-enabled-handler img", "' . Url::toRoute('toggle') . '");');
    