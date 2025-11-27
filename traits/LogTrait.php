<?php

namespace app\traits;

use app\models\LogData;
use yii\db\Exception;

trait LogTrait
{
    /**
     * @return void
     * @throws Exception
     */
    public function logChanges(): void
    {
        $oldAttributes = $this->getOldAttributes();
        $newAttributes = $this->attributes;
        foreach ($newAttributes as $name => $value) {
            if (isset($oldAttributes[$name]) && $oldAttributes[$name] !== $value) {
                $logData = new LogData();
                $logData->model_name = static::class;
                $logData->model_id = $this->primaryKey;
                $logData->attribute = $name;
                $logData->old_value = (string)$oldAttributes[$name];
                $logData->new_value = $value;
                $logData->save(false);
            }
        }
    }
}
