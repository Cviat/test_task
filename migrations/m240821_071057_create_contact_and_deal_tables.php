<?php
use yii\db\Migration;

/**
 * Class m240821_071057_create_contact_and_deal_tables
 */
class m240821_071057_create_contact_and_deal_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы contact
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(50),
        ]);

        // Создание таблицы deal
        $this->createTable('deal', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'amount' => $this->decimal(10, 2),
        ]);

        // Создание связывающей таблицы для контактов и сделок
        $this->createTable('deal_contact', [
            'deal_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull(),
        ]);

        // Добавление начальных данных в таблицу contact
        $this->batchInsert('contact', ['first_name', 'last_name', 'email', 'phone'], [
            ['Иван', 'Иванов', 'ivan.ivanov@example.com', '+7 900 123 45 67'],
            ['Наталья', 'Сидорова', 'natalya.sidorova@example.com', '+7 900 234 56 78'],
            ['Василий', 'Петров', 'vasiliy.petrov@example.com', '+7 900 345 67 89'],
        ]);

        // Добавление начальных данных в таблицу deal
        $this->batchInsert('deal', ['title', 'amount'], [
            ['Хотят люстру', 4000.00],
            ['Пока думают', 0.00],
            ['Хотят светильник', 3000.00],
        ]);

        // Добавление данных в связывающую таблицу deal_contact
        $this->batchInsert('deal_contact', ['deal_id', 'contact_id'], [
            [1, 1],
            [2, 2],
            [3, 3],
            [1, 2], // Пример сделки с двумя контактами
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление связывающей таблицы сначала
        $this->dropTable('deal_contact');
        $this->dropTable('deal');
        $this->dropTable('contact');
    }
}
