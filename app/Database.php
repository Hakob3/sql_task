<?php

namespace App;

use PDO;

class Database
{
    private ?PDO $connection;

    public function __construct()
    {
        // Установка соединения с базой данных
        $this->connection = new PDO('mysql:host=db;dbname=sql_db', 'root', 'password');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getLatestData($id)
    {
        // Запрос для получения последних 20 записей
        $sql = "SELECT ID, CR, AR, IRR, EPC, EPL
                FROM excel_table
                WHERE AR = (SELECT AR FROM excel_table WHERE ID = :id)
                  AND CR = (SELECT CR FROM excel_table WHERE ID = :id)
                ORDER BY ID DESC
                LIMIT 20";

//         Подготовка и выполнение запроса
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $id]);

        // Получение результатов запроса
        $latestData = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $latestData;
    }

    public function insertData($data): void
    {
        // Подготовка и выполнение запроса на вставку данных
        $sql = "INSERT INTO excel_table (ID, CR, AR, IRR, EPC, EPL) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);
        foreach ($data as $row) {
            $statement->execute($row);
        }
    }

    public function clearTable(): void
    {
        $this->connection->query("TRUNCATE TABLE excel_table");
    }

    public function closeConnection(): void
    {
        // Закрытие соединения с базой данных
        $this->connection = null;
    }
}
