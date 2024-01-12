<?php

namespace app\controllers;

use app\models\Manager;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * ManagerController реализует CRUD-действия для модели менеджера.
 */
class ManagerController extends Controller
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
     *Перечислены все модели менеджеров.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Manager::find(),
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
     * Отображает единую модель Manager.
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
     * Создает новую модель Manager.
     * Если создание завершится успешно, браузер будет перенаправлен на страницу "просмотр"
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Manager();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Обновляет существующую модель Manager.
     * Если обновление пройдет успешно, браузер будет перенаправлен на страницу "просмотр".
     * @param int $id id
     * @return string|Response
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->load($this->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $model->image_file = $model->imageFile->name;
                    $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удаляет существующую модель Manager.
     * Если удаление пройдет успешно, браузер будет перенаправлен на страницу "индекс".
     * @param int $id id
     * @return Response
     * @throws NotFoundHttpException если модель не может быть найдена
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Находит модель Manager model на основе значения ее первичного ключа.
     * Если модель не найдена, будет выдано исключение HTTP 404.
     * @param int $id id
     * @return Manager загруженная модель
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    protected function findModel(int $id): Manager
    {
        $model = Manager::findOne(['id' => $id]);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }
}
