<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Database;
use App\ExcelImporter;

// Создаем экземпляр класса Database
$db = new Database();

$importer = new ExcelImporter();
$importer->importData('excel_table.xlsx');

// Получаем последние 20 записей с помощью метода getLatestData()
$latestData = $db->getLatestData(29);

// Выводим полученные данные
foreach ($latestData as $row) {
    echo "ID: {$row['ID']}, CR: {$row['CR']}, AR: {$row['AR']}, IRR: {$row['IRR']}, EPC: {$row['EPC']}, EPL: {$row['EPL']}\n";
}
$db->clearTable();

// Закрываем соединение с базой данных
$db->closeConnection();
