<?php


namespace app\controllers;

use app\models\Contact;
use Yii;
use app\models\Deal;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\widgets\ActiveForm;

class DealController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Deal::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $deal = $this->findModel($id);

        return $this->render('view', [
            'deal' => $deal,
        ]);
    }

    public function actionCreate()
    {
        $model = new Deal();

        // Получаем список контактов
        $contacts = ArrayHelper::map(Contact::find()->all(), 'id', function($contact) {
            return $contact->first_name . ' ' . $contact->last_name;
        });

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['dashboard/index', 'type' => 'deals', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'contacts' => $contacts, // Передаем список контактов
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Получаем список контактов
        $contacts = ArrayHelper::map(Contact::find()->all(), 'id', function($contact) {
            return $contact->first_name . ' ' . $contact->last_name;
        });

        // Получаем выбранные контакты для текущей сделки
        $selectedContacts = ArrayHelper::map($model->contacts, 'id', 'id');

        // Устанавливаем выбранные контакты в модель
        $model->contact_ids = array_keys($selectedContacts);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['dashboard/index', 'type' => 'deals', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'contacts' => $contacts, // Передаем список контактов
        ]);
    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['dashboard/index', 'type' => 'deals' ,]);
    }

    protected function findModel($id)
    {
        if (($model = Deal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
