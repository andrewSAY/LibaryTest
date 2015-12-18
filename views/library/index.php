<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataModels\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
\yii\helpers\Url::remember(\yii\helpers\Url::current(), 'index_');
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'date_create',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function ($model)
                    {
                        $paths = explode(',', $model->preview);
                        if(count($paths) != 2)
                        {
                            return 'No image';
                        }
                        return Html::a(Html::img(\yii\helpers\Url::to('@web/' . $paths[0])), \yii\helpers\Url::to('@web/' . $paths[1]), array('class' => 'image-popup-vertical-fit'));
                    },
            ],
            'date',

            ['class' => \yii\grid\DataColumn::className(),
                'header' => 'Actions',
                'format' => 'html',
                'value' => function ($model)
                    {
                        $value = Html::a(' Edit ', \yii\helpers\Url::to(array('library/update', 'id' => $model->id)));
                        $value .= Html::a(' Show ', \yii\helpers\Url::to(array('library/view', 'id' => $model->id)));
                        $value .= Html::a(' Delete ', \yii\helpers\Url::to(array('library/delete', 'id' => $model->id)));
                        return $value;
                    },
            ],
        ],
    ]); ?>
</div>
<script type="text/javascript">
    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

</script>

