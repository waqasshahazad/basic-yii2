<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo Yii::t("app","Tips and Tricks!")?></h1>

        <p class="lead"><?php echo Yii::t("app","Follow this pattern to create a Company")?></p>

    </div>

    <div class="body-content">

        <div class="row">
          <div class="col-lg-4">
              <h2><?php echo Yii::t("app","1.Create a Company")?></h2>

              <p><?php echo Yii::t("app","Company's complete contact detail is available in detail view.")?> </p>

              <p><a class="btn btn-default" href="/company/create"><?php echo Yii::t("app","Create New Company")?> &raquo;</a></p>
          </div>

            <div class="col-lg-4">
                <h2><?php echo Yii::t("app","2.Create Address")?></h2>

                <p><?php echo Yii::t("app","Create a Address to be assinged to a contac person")?> </p>


                <p><a class="btn btn-default" href="/address/create"><?php echo Yii::t("app","Create New Address")?> &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2><?php echo Yii::t("app","3.Create Contact Person")?></h2>

                <p><?php echo Yii::t("app","Contact complete detail is available in detail view. ")?> </p>


                <p><a class="btn btn-default" href="/contact/create"><?php echo Yii::t("app","Create Contact Person")?> &raquo;</a></p>
            </div>


        </div>

    </div>
</div>
