<?php

namespace app\controllers;

use app\models\ProductsGuide;
use app\models\Provider;
use app\models\Receipt;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ReceiptController реализует действия CRUD для модели Receipt.
 */
class ReceiptController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Перечислены все модели Receipt.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Receipt::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Отображает единую модель Receipt.
     * @param int $id id
     * @return string
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создает новую модель Receipt.
     * Если создание прошло успешно, браузер будет перенаправлен на страницу "просмотр".
     * @return string|Response
     */
    public function actionCreate()
    {
        $productsGuide = ProductsGuide::find()->all();
        $providers     = Provider::find()->all();

        $model = new Receipt();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model'         => $model,
            'productsGuide' => $productsGuide,
            'providers'     => $providers,
        ]);
    }

    /**
     * Обновляет существующую модель Receipt.
     * Если обновление прошло успешно, браузер будет перенаправлен на страницу "просмотр".
     * @param int $id id
     * @return string|Response
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionUpdate(int $id)
    {
        $productsGuide = ProductsGuide::find()->all();
        $providers     = Provider::find()->all();

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'         => $model,
            'productsGuide' => $productsGuide,
            'providers'     => $providers,
        ]);
    }

    /**
     * Удаляет существующую модель Receipt.
     * Если удаление прошло успешно, браузер будет перенаправлен на страницу "index".
     * @param int $id id
     * @return Response
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionDelete(int $id): Response
    {
         $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Находит модель Receipt на основе значения ее первичного ключа.
     * Если модель не найдена, будет выдано исключение HTTP 404.
     * @param int $id id
     * @return Receipt загруженная модель
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    protected function findModel(int $id): Receipt
    {
        if (($model = Receipt::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }
}
