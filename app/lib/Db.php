<?php
namespace CvMaker;

/**
 * Class Db
 * @package CvMaker
 */
class Db {
    /**
     * Datubāzes savienojums
     *
     * @var
     */
    private static $db;

    /**
     * Inicializējam datubāzi ( singleton metode )
     * Datubāzes uzstādījumi glabājas failā app/config/config.php
     *
     * @return \PDO
     */
    public static function init()
    {
        if (!self::$db)
        {
            try {
                self::$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
                self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                // Datubāzes pieslēgšanās nav obligāta, tāpēc neko nedarām.
            }
        }
        return self::$db;
    }
}