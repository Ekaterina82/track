<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\traits\LogTrait;

/**
 * @property int $id
 * @property string $track_number
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 */
class Track extends ActiveRecord
{
    use LogTrait;

    const STATUS_NEW            = 'new';
    const STATUS_IN_PROGRESS    = 'in_progress';
    const STATUS_COMPLETED      = 'completed';
    const STATUS_FAILED         = 'failed';
    const STATUS_CANCELED       = 'canceled';

    const STATUS_LIST = [
        self::STATUS_NEW => 'New',
        self::STATUS_IN_PROGRESS => 'In progress',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_FAILED => 'Failed',
        self::STATUS_CANCELED => 'Canceled',
    ];

    public function rules(): array
    {
        return [
            [['track_number', 'status'], 'required'],
            ['track_number', 'unique', 'message' => '"Номер трека" должен быть уникальным'],
            ['track_number', 'string'],
            ['status', 'in', 'range' => array_keys(self::STATUS_LIST), 'message' => '"Статус" может принимать только одно из значений:' . implode("; ", array_keys(self::STATUS_LIST))],
            [['created_at', 'updated_at'],  'datetime', 'format' => 'php:Y-m-d H:i:s', 'message' => 'Неверный формат даты. Надо Y-m-d H:i:s'],
        ];
    }

    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{track}}';
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'Идентификатор',
            'track_number' => 'Номер трека (уникальный)',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата внесения изменений',
            'status' => 'Статус трека',
        ];
    }

    /**
     * Get status label
     * @return string
     */
    public function getStatusLabel(): string
    {
        return self::STATUS_LIST[$this->status] ?? $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);
    }

    //Логирование внесенных изменений
    public function beforeSave($insert)
    {
        $this->logChanges();
        return parent::beforeSave($insert);
    }
}