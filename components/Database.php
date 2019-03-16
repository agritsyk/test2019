<?php 

declare(strict_types=1);

class Database {
    public const USER_TABLE = 'user';

    /**
     * @var PDO|null
     */
    public static $connection;

	public static function getDatabaseConnection(): PDO
	{
	    if (null === self::$connection) {
            $dbParams = include_once(ROOT . '/config/db_config.php');
            $dsn = "mysql:dbname={$dbParams['dbname']};host={$dbParams['host']}";
            try {
            $db = new PDO($dsn, $dbParams['user'], $dbParams['password']);
            } catch (PDOException $e) {
                echo "Database ERROR: " . $e->getMessage();
                die();
            }
            $db->exec('set names utf8');
            self::$connection = $db;
        }

        return self::$connection;
	}

	public static function deleteAllFromUser(): void
    {
        $db = Database::getDatabaseConnection();
        $query = 'DELETE FROM '.self::USER_TABLE;
        $result = $db->prepare($query);
        $result->execute();
    }

    public static function getUsersList(): array
    {
        $db = Database::getDatabaseConnection();
        $query = 'SELECT * FROM '.self::USER_TABLE;
        $result = $db->prepare($query);
        $result->execute();

        $usersList = [];

        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['uid'] = $row['uid'];
            $usersList[$i]['name'] = $row['name'];
            $usersList[$i]['age'] = $row['age'];
            $usersList[$i]['email'] = $row['email'];
            $usersList[$i]['phone'] = $row['phone'];
            $usersList[$i]['gender'] = $row['gender'];
            $i++;
        }

        return $usersList;
    }
}