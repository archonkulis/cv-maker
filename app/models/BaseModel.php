<?php
/**
 * Class BaseModel
 */
class BaseModel {
    /**
     * Datubāzes modelis
     *
     * @var PDO
     */
    protected $_db;

    /**
     * Inicializējam datubāzes savienojumu
     *
     */
    public function __construct()
    {
        $this->_db = \CvMaker\Db::init();
    }
}