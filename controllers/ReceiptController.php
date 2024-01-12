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
use yii\web\UploadedFile;

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
     * Загружает csvFile
     *
     * @return Response
     */
    public function actionUploadCsv(): Response
    {
        $csvFile = UploadedFile::getInstanceByName('csvFile');
        if ($csvFile !== null) {
            $filePath = 'uploads/' . $csvFile->baseName . '.' . $csvFile->extension;
            $csvFile->saveAs($filePath);

            $csvData = file_get_contents($filePath);
            $data = str_getcsv($csvData, "\n");

            unset($data[0]);

            foreach($data as $row) {
                $row = str_getcsv($row, ";");
                $row = mb_convert_encoding($row, "utf-8", "CP1251");

                $receipt = new Receipt();
                $receipt->setAttributes([
                    'product_id' => $row[0],
                    'provider_id' => $row[1],
                    'price' => $row[2],
                    'quantity' => $row[3],
                    'time_of_receipt' => date('Y-m-d H:i:s'),
                ]);
                $receipt->save();
            }
            //unlink($filePath); // Удаляем загруженный файл
        }
        return $this->redirect('index');
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
                    $model->time_of_receipt = date('Y-m-d H:i:s');
                    $model->save();
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
