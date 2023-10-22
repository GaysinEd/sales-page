<?php

namespace app\controllers;


use Yii;
use app\models\Sales;
use yii\web\Controller;
use app\models\ProductsGuide;
use app\models\Manager;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SalesController extends Controller
{

    public function actionIndex() //$id
    {

        $productsGuide    = ProductsGuide::find()->all();
        $managers         = Manager::find()->all();
//        $sales            = Sales::find()->all();



//        $posts = Yii::$app->db->createCommand('SELECT name FROM products_guide WHERE id=:id')
//            ->bindValue(':id', 2)
//            ->queryOne();
//            echo '<pre>';
//            var_dump($posts);
//            echo '</pre>';
//            exit();

//        Yii::$app->db->createCommand()->insert('products_guide', [
//            'name'      => 'футболка',
//            'price'     => 150,
//            'quantity'  => 5,
//        ])->execute();

//        Yii::$app->db->createCommand()->delete('products_guide', 'id = 8')->execute();


//        $rows = (new \yii\db\Query())
//            ->select(['*'])
//            ->from('products_guide')
//            ->where(['id' => 2])
//            ->limit(10)
//            ->all();
//            echo '<pre>';
//            var_dump($rows);
//            echo '</pre>';
//            exit();

//        $rows = (new \yii\db\Query())->select('COUNT(*)')->from('products_guide')->all();
//            echo '<pre>';
//            var_dump($rows);
//            echo '</pre>';
//            exit();

//        $rows = (new \yii\db\Query())->select(['*'])->from('products_guide');
//        $row = $rows->where([
//            'id' => 2,
//            'price' => 7000,
//        ])->all();                                      // почему без ->all() не работает ?
//            echo '<pre>';
//            var_dump($row);
//            echo '</pre>';
//            exit();

//       $rows = (new \yii\db\Query())
//           ->select(['*'])
//           ->from('products_guide')
//           ->join('LEFT JOIN', 'sales', 'id = product_id');   //? как можно вывести в виде таблицы

//        $rows = (new \yii\db\Query())
//            ->select(['*'])
//            ->from('products_guide')
//            ->count();
//            echo '<pre>';
//           var_dump($rows);
//            echo '</pre>';
//            exit();


//        $rows = (new \yii\db\Query())
//            ->select(['*'])
//            ->from('products_guide')
//            ->count();
//        echo '<pre>';
//        var_dump($rows);
//        echo '</pre>';
//        exit();

//        $rows = (new \yii\db\Query())
//            ->from('products_guide')
//            ->orderBy('id');
//        echo '<pre>';
//        foreach ($rows->batch() as $row){
//            var_dump($row);
//        };
//        echo '</pre>';
//        exit();

//        $modelManager = new Manager();
//        $modelManager->name = 'Егор';
//        $modelManager->save();

//        $modelManager = Manager::find()
//            ->indexBy('id')
//            ->asArray()
//            ->all();
//        echo '<pre>';
//        var_dump($modelManager);
//        var_dump($modelManager[2]);
//        echo '</pre>';
//        exit();

//        $manager = Manager::findOne(9);
//        $manager->delete();

//        $manager = Manager::findOne(1);
//        $saleManager = $manager->sales->num;
//        echo '<pre>';
//        var_dump($saleManager);
//        echo '</pre>';
//        exit();




        //$salesName = Sales::findOne(2);

//        $salesName = Sales::findOne($id);
//        $product = $salesName->getName();

//        $dataProvider     = new ActiveDataProvider([
//            'query'       => Sales::find()
//            ]);


//        $sales = Manager::find()->one()->getSales()->all();        //getSales?/ asArray() не отображается?
//        var_dump($sales);

//        $modelManager = new Manager();
//        $manager = Sales::find()->one()->?->all();          //не могу выбрать по id ???
//        var_dump($manager);
//        exit();

//        $manager = Manager::findOne(1);
//        $sales = $manager->sales;
//        var_dump($sales);

//        $manager = Manager::findOne(1);   //?
//        $sales = $manager->getSales();
//        var_dump($sales);

//        echo "<pre>";
//        $sale = Sales::findOne(['id' => 5]);
//        $manager = $sale->getManager()->one();
//        if($manager instanceof Manager)
//        {
//            print_r($manager->shortName);                   //? почему не могу обратиться к свойству объекта
//            exit();
//        }


        $modelSales   = new Sales();

        if ($modelSales->load(Yii::$app->request->post()) && $modelSales->validate()) {
            $modelSales->time_of_sale = date('Y-m-d H:i:s');
            if ($modelSales->save()) {
                return $this->refresh();
            }
        }//else{
//            echo '<pre>';
//            var_dump($modelSales->errors);
//            echo '</pre>';
//        }

//        $get = Yii::$app->request->get();
//           echo '<pre>';
//            var_dump($get);
//           echo '</pre>';
//           exit();


//        $query = Manager::find()->orderBy(['id' => SORT_DESC])->all();
//            echo '<pre>';
//            var_dump($query);
//            echo '</pre>';
//            exit();



//        $modelManager = new Manager();
//        $managerIdLastSale = $modelManager->managerIdLastSale;
//        $lastShortName = Manager::findOne($managerIdLastSale)->shortName;
//        var_dump($lastShortName);



//        $sale = Sales::findOne(5);
//        var_dump($sale->getManager()->getShortName());           //? как к методу обратиться
//        exit();

//        $modelManager = new Manager();
//        $managerIdLastSale = $modelSales->managerIdLastSale;       //?
//        if ($managerIdLastSale == $modelSales->manager_id)
//        {
//            return $modelManager->getShortName();
//        }







        return $this->render('index', [
            'productsGuide'      => $productsGuide,
            'managers'           => $managers,
//            'sales'              => $sales,
            'modelSales'         => $modelSales,
            //'$lastShortName'     => $lastShortName,
//            'rows'               => $rows,
            //'$modelManager'      => $modelManager,
            //'product'            => $product,
            //'dataProvider'       => $dataProvider,
        ]);

        
    }

//    public function actionCreate()
//    {
//        $modelSalesList = new SalesList();
//
//        if ($modelSalesList->load(Yii::$app->request->post()) && $modelSalesList->validate()) {
//            if ($modelSalesList->save()) {
//                return $this->refresh();
//            }
//        }
//
//        return $this->render('index', [
//            'modelSalesList' => $modelSalesList,
//        ]);
//    }




    /**
     * @throws NotFoundHttpException
     */
/*    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $productsGuide = ProductsGuide::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'productsGuide' => $productsGuide,
            ]);
        }
    }

    /**
     * @throws NotFoundHttpException
     */
/*    private function findModel($id): ProductsGuide
    {
        $model = ProductsGuide::findOne(['id' => $id]);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
*/
}

