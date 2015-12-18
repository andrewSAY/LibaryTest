<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_083033_persist_primary_data extends Migration
{
    public function safeUp()
    {
        $author = new \app\models\DataModels\Authors();

        $author->first_name = 'Twen';
        $author->last_name = 'Mark';
        $author->save();

        $author = new \app\models\DataModels\Authors();
        $author->first_name = 'London';
        $author->last_name = 'Jack';
        $author->save();

        $author = new \app\models\DataModels\Authors();
        $author->first_name = 'Dyuma';
        $author->last_name = 'Alexandre';
        $author->save();


    }

    public function safeDown()
    {
        \app\models\DataModels\Authors::deleteAll('');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
