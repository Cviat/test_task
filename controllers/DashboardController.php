<?php

namespace app\controllers;

use Yii;
use app\models\Deal;
use app\models\Contact;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex($type = 'deals', $id = 1)
    {
        $deals = Deal::find()->all();
        $contacts = Contact::find()->all();
        $selectedItem = null;

        if ($type === 'deals') {
            $selectedItem = Deal::findOne($id);
            if ($selectedItem === null && !empty($deals)) {
                // Если выбранная сделка не найдена, выбрать первую сделку
                $selectedItem = $deals[0];
            }
        } elseif ($type === 'contacts') {
            $selectedItem = Contact::findOne($id);
            if ($selectedItem === null && !empty($contacts)) {
                // Если выбранный контакт не найден, выбрать первый контакт
                $selectedItem = $contacts[0];
            }
        }

        return $this->render('index', [
            'deals' => $deals,
            'contacts' => $contacts,
            'selectedItem' => $selectedItem,
            'selectedType' => $type,
        ]);
    }



}

