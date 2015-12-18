<?php

namespace app\models\DataModels;

use app\models\ImageWorker\ImageModifier;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property resource $date_create
 * @property resource $date_update
 * @property string $preview
 * @property resource $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    private $file;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->on(ActiveRecord::EVENT_BEFORE_INSERT, array($this, 'onSave'));
        $this->on(ActiveRecord::EVENT_BEFORE_UPDATE, array($this, 'onSave'));
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update', 'preview', 'file'], 'safe'],
            [['name', 'author_id', 'date'], 'required'],
            [['author_id'], 'integer'],
            [['file'], 'file'],
            [['date'], 'date', 'format' => 'yyyy-MM-dd'],
            [['name'], 'string', 'max' => 255],
            [['preview'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'preview' => 'Превью',
            'date' => 'Дата выхода',
            'author_id' => 'Автор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @inheritdoc
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function onSave($event)
    {
        $date = (new \DateTime())->format('Y-m-d H:i');
        if (!$this->date_create)
        {
            $this->date_create = $date;
        }

        $this->date_update = $date;
        $this->saveFile();
    }

    private function saveFile()
    {
        if (!is_object($this->file))
        {
            return;
        }
        if (!file_exists('upload/'))
        {
            mkdir('upload/');
        }
        $filename = 'upload/' . $this->file->baseName . '/';
        if (!file_exists($filename))
        {
            mkdir($filename);
        }
        $this->file->saveAs('../web/' . $filename . 'big.' . $this->file->extension);
        $imgModifier = new ImageModifier();
        $imgModifier->open('../web/' . $filename . 'big.' . $this->file->extension);
        $imgModifier->reduceImageTo(50);
        $imgModifier->saveOrFlush('../web/' . $filename . 'small.' . $this->file->extension);
        if (file_exists('../web/' . $filename . 'big.' . $this->file->extension))
        {
            $this->preview = $filename . 'small.' . $this->file->extension . ',' . $filename . 'big.' . $this->file->extension;
        }
    }
}
