<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Properties */
/* @var $form ActiveForm */

/*notes: $model now becomes $properties and $images (for the ImagePath attribute)*/

?>
<div class="site-addproperty">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>



        <?= $form->field($properties, 'Address1') ?>
        <?= $form->field($properties, 'Address2') ?>
        <?= $form->field($properties, 'Address3') ?>
        <?= $form->field($properties, 'Postcode') ?>
        <?= $form->field($properties, 'Type') ?>
        <?= $form->field($properties, 'Price') ?>
        <?= $form->field($properties, 'Description') ?>
        <?= $form->field($properties, 'SaleStatus') ?>




        <?= $form->field($images, 'ImagePath')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-addproperty -->
