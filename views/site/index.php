<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">Start using service right now!</p>

        <p><a class="btn btn-lg btn-success" href="/site/signup">Signup</a></p>



    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Best Courier</h2>

                <p><?= $best ?></p>

                <p><a class="btn btn-default" href="site/couriers">All couriers &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
