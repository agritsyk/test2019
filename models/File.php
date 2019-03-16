<?php

declare(strict_types=1);

class File
{
    const MAX_FILE_SIZE = 1024 * 1024;

    public static $types = ['csv' => 'application/vnd.ms-excel'];
    public static $tableColumns = ['UID', 'Name', 'Age', 'Email', 'Phone', 'Gender'];


    public $fileName;
    public $fileTmpName;
    public $fileSize;
    public $fileType;
    public $fileContent;

    public function __construct(array $file)
    {
        $this->fileName = $file['name'];
        $this->fileTmpName = $file['tmp_name'];
        $this->fileSize = $file['size'];
        $this->fileType = $file['type'];
    }

    public function checkFileSize(): bool
    {
        if ($this->fileSize < self::MAX_FILE_SIZE) {
            return true;
        }

        return false;
    }

    public function checkFileTypeCSV(): bool
    {
        if ($this->fileType == self::$types['csv']) {
            return true;
        }

        return false;
    }

    public function checkFileIsUploaded(): bool
    {
        if (is_uploaded_file($this->fileTmpName)) {
            return true;
        }

        return false;
    }

    public function getFileContent(): array
    {
        $content = [];

        if (($handle = fopen($this->fileTmpName, 'r')) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, ',')) !== false) {
                $num = count($data);
                for ($i = 0; $i < $num; $i++) {
                    $content[$row][$i] = $data[$i];
                }
                $row++;
            }
        }
        fclose($handle);

        return $content;
    }

    public function isValidFileContent(array $fileContent): bool
    {
        if ($fileContent[0] === self::$tableColumns) {
            return true;
        }

        return false;
    }

    public function importToDB(array $fileContent): void
    {
        $query = "INSERT INTO user (uid, name, age, email, phone, gender) VALUES (?, ?, ?, ?, ?, ?) 
              ON DUPLICATE KEY UPDATE name = VALUES(name), age = VALUES(age), email = VALUES(email), 
              phone = VALUES(phone), gender = VALUES(gender)";

        $db = Database::getDatabaseConnection();
        $dataCount = count($fileContent) - 1;
        for ($i = 1; $i <= $dataCount; $i++) {
            $result = $db->prepare($query);
            $result->execute($fileContent[$i]);
        }
    }

    public static function saveToFileFromDB(string $fileName): void
    {
        $usersList = Database::getUsersList();
        $handle = fopen($fileName, 'w');
        fputcsv($handle, self::$tableColumns);

        foreach ($usersList as $user) {
            fputcsv($handle, $user);
        }

        fclose($handle);
    }
}