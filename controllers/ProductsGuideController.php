<?php

namespace app\controllers;

use app\models\Category;
use app\models\ProductsGuide;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ProductsGuideController реализует действия CRUD для модели ProductsGuide.
 */
class ProductsGuideController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     *Перечислены все модели продуктов.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductsGuide::find(),
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

        return $this ->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Отображает единую модель ProductsGuide.
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
     * Создает новую модель ProductsGuide.
     * Если создание завершится успешно, браузер будет перенаправлен на страницу "просмотр".
     * @return string|Response
     */

    public function actionCreate()
    {
        $category = Category::find()->all();

        $model = new ProductsGuide();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'    => $model,
            'category' => $category,
        ]);
    }

    /**
     * Обновляет существующую модель ProductsGuide.
     * Если обновление пройдет успешно, браузер будет перенаправлен на страницу "просмотр".
     * @param int $id id
     * @return string|Response
     * @throws NotFoundHttpException если модель не может быть найдена
     */

    public function actionUpdate(int $id)
    {
        $category = Category::find()->all();

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'    => $model,
            'category' => $category,
        ]);
    }

    /**
     * Удаляет существующую модель ProductsGuide.
     * Если удаление пройдет успешно, браузер будет перенаправлен на страницу "индекс".
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
     * Находит модель ProductsGuide на основе значения ее первичного ключа.
     * Если модель не найдена, будет выдано исключение HTTP 404.
     * @param int $id id
     * @return ProductsGuide загруженная модель
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    protected function findModel(int $id): ProductsGuide
    {
        if (($model = ProductsGuide::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }

}