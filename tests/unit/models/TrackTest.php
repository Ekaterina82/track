<?php

namespace tests\unit\models;

use app\models\Track;
use app\controllers\TrackController;
use Yii;

class TrackTest extends \PHPUnit\Framework\TestCase
{
    // Проверка
    public function testCalculate()
    {
        $this->assertSame(2, 1 + 1);
    }

    public function testCreateTrackModel()
    {
        $track = new Track();
        $track->track_number = '159';
        $track->status = 'белиберда какая то';//Track::STATUS_NEW;
        $track->created_at = (new \DateTime())->format("Y.m.d H:i:s");
        $track->updated_at = (new \DateTime())->format("Y-m-d H:i:s");

        $validate = $track->validate();
        $this::assertTrue($validate, print_r($track->getErrors(), true));

    }

    public function testTrackControllerIndex()
    {

    }

    public function testTrackControllerView()
    {

    }

    public function testTrackControllerGet()
    {

    }

    public function testTrackControllerCreate()
    {
        $controller = new TrackController('TrackController', Yii::$app);
        $postData = [
            "track_number" => '78956',
            "status" => Track::STATUS_NEW,
            "created_at"  => (new \DateTime())->format("Y.m.d H:i:s"),
            "updated_at" => (new \DateTime())->format("Y.m.d H:i:s"),
        ];

        $webRequest = new \yii\web\Request();
        $webRequest->setBodyParams($postData);
        Yii::$app->set('request', $webRequest);
        $result = $controller->actionCreate($webRequest);
        $this::assertTrue($result, print_r($result->getErrors(), true));
    }

    public function testTrackControllerUpdate()
    {

    }

    public function testTrackControllerDelete()
    {


    }
}