<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = 'Update Delivery: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>
    <?= $form->field($model, 'courier_id')->dropDownList( $couriers) ?>
    <?= $form->field($model, 'isDelivered')->dropDownList(['prompt' => 'Choose value','0' => 'No info yet','1' => 'Failt', '2' => 'Done']) ?>







    <div class="form-group">
        <?= Html::submitButton( 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

