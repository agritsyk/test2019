<?php

declare(strict_types=1);

class SiteController
{
    public function actionIndex(): void
    {
        if (isset($_GET['clear']) && ($_GET['clear']) == 1)
        {
            $infoMessage = 'Database successfully cleared';
        }

        if (isset($_POST['submit'])) {
            $errors = false;

            if (($_FILES['userfile']['size'] > 0)) {

                $file = new File($_FILES['userfile']);

                if (!$file->checkFileIsUploaded()) {
                    $errors[] = 'Error uploading file!';
                }

                if (!$file->checkFileSize()) {
                    $errors[] = 'File is bigger than 1 MB!';
                }

                if (!$file->checkFileTypeCSV()) {
                    $errors[] = 'Wrong type of file!';
                }

                $fileContent = $file->getFileContent();
                if (!$file->isValidFileContent($fileContent)) {
                    $errors[] = 'Wrong file structure!';
                }

                if (false === $errors) {
                    $file->importToDB($fileContent);
                    $infoMessage = 'File successfully imported to database';
                }
            } else {
                $errors[] = 'Please, choose your file';
            }
        }

        require_once ROOT . '/views/site/index.php';
    }

    public function actionResults(): void
    {
        $usersList = Database::getUsersList();

        require_once ROOT . '/views/site/results.php';
    }

    public function actionClear(): void
    {
        Database::deleteAllFromUser();

        header("Location: /?clear=1");
    }

    public function actionExportToCsv(): void
    {
        $fileName = 'temp/users.csv';
        File::saveToFileFromDB($fileName);

        header ("Content-Type: " . File::$types['csv']);
        header ("Accept-Ranges: bytes");
        header ("Content-Length: ".filesize($fileName));
        header ("Content-Disposition: attachment; filename=database.csv");
        readfile($fileName);
        unlink($fileName);
    }
}