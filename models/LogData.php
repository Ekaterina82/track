<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Exception;

class LogData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%log_data}}';
    }

}
