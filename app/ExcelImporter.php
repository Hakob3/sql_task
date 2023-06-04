<?php

namespace App;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImporter
{
    public function importData($file): void
    {
        // Подключение к базе данных
        $db = new Database();

        // Загрузка файла Excel
        $spreadsheet = IOFactory::load(dirname(__DIR__) . '/public/' . $file);
        $worksheet = $spreadsheet->getActiveSheet();

        // Получение данных из файла и вставка их в базу данных
        $data = [];

        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestRow()) as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            if (!$rowData[0]) {
                continue;
            }
            $data[] = $rowData;
        }
        $db->insertData($data);
        // Закрытие соединения с базой данных
        $db->closeConnection();
    }
}
