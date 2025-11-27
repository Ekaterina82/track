<?php

namespace app\controllers;

use app\models\Track;
use app\models\TrackSearch;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use Yii;

class TrackController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::class;
        $behaviors['authenticator']['only'] = ['update','delete'];
        return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'actions' => ['index', 'view','get', 'create'], // действия доступные не залогинившимся пользователям
                    'allow' => true,
                    'roles' => ['?'], // гость
                ],
                                [
                    'actions' => ['index', 'view','get', 'create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@'], // пользователь, прошедший аутентификацию
                ]
            ],
            'denyCallback' => function () {
                throw new ForbiddenHttpException('У вас нет доступа к этой странице');
            }
        ]
        ];
    }

    /*
    * API GET LIST TRACK
    */
    public function actionIndex(): string
    {
        $searchModel = new TrackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }

    /*
     * API GET
     */
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => Track::findOne($id),
        ]);
    }

    public function actionGet($track_number)
    {
        $model = Track::findOne(['track_number' => $track_number]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * API POST
     */
    public function actionCreate(): Response|string
    {
        $model = new Track();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * API UPDATE
     */
    public function actionUpdate($id): Response|string
    {
        $model = Track::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * API DELETE
     */
    public function actionDelete($id): Response
    {
        $model = Track::findOne($id);
        $model->delete();

        return $this->redirect(['index']);
    }

}
