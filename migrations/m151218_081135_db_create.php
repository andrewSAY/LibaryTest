<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_081135_db_create extends Migration
{
    public function safeUp()
    {
        $this->createTable('authors', array(
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . '(255) NULL',
            'last_name' => Schema::TYPE_STRING . '(255) NULL'
        ));

        $this->createTable('books', array(
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NULL',
            'date_create' => Schema::TYPE_DATETIME,
            'date_update' => Schema::TYPE_DATETIME,
            'preview' => Schema::TYPE_STRING . '(1024) NULL',
            'date' => Schema::TYPE_DATETIME,
            'author_id' => Schema::TYPE_INTEGER,
        ));

        $this->createIndex('author_index', 'books', 'author_id');
        $this->addForeignKey('fk_author_books', 'books', 'author_id', 'authors', 'id', 'cascade');

    }

    public function safeDown()
    {
        $this->dropTable('books');
        $this->dropTable('authors');
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
