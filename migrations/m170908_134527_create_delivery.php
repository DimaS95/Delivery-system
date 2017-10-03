<?php

use yii\db\Migration;

class m170908_134527_create_delivery extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170908_134527_create_delivery cannot be reverted.\n";

        return false;
    }


    public function up()
    {
        $this->createTable('delivery', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'user_id'=>$this->integer()
        ]);
    }

    public function down()
    {


        $this->dropTable('delivery');
    }

}
