<?php
/**
 * Created by PhpStorm.
 * User: muzaffer
 * Date: 31.01.2019
 * Time: 12:35
 */
include_once ROOT_PATH.'/data/abstract/MysqliDb.php';
include_once ROOT_PATH.'/data/config.php';
include_once ROOT_PATH . "/entities/abstract/IEntity.php";

abstract class DatabaseTableDao extends MysqliDb
{

    private $IEntity = IEntity::class;

    private $Extension = 'wp_';

    private $database;

    private $TableName;

    private $Column;

    private $value;


    public function CreateTable(IEntity $IEntity, $TableName = null)
    {
        $this->database = MySqliDb::getInstance();
        $this->IEntity = $IEntity;
        $this->_instance = $this->IEntity;

        self::createColumnAndTableName($TableName);


        if (!$this->database->tableExists($this->TableName)) {
            $sql =
                "CREATE TABLE " . $this->TableName . " (
 			ID INT(32) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 			" . $this->value . ")";
            $this->rawQuery($sql);
        }

        return $this->Column;
    }

    public function insert($array = array())
    {
        $id = $this->database->insert($this->TableName, $array);
        if ($id)
            return $id;
        else
            return false;
    }

    public function update($array = array(), $where = array())
    {
        self::where($where);
        $id = $this->database->update($this->TableName, $array);
        if ($id)
            return $id;
        else
            return false;
    }

    public function select($where = array())
    {
        self::where($where);
        return $this->database->getOne($this->TableName);

    }

    public function selectAll($where = array(), $howManyData = null)
    {

        self::where($where);
        return $this->database->get($this->TableName, $howManyData);
    }

    public function delete($where = array())
    {
        self::where($where);
        if ($this->database->delete($this->TableName))
            return true;
        else
            return false;

    }


    public function where($where = array(),$order=array())
    {
        if ($where) {
            foreach ($where as $key => $value) {
                $this->database->where($key, $value);
            }
        }
        if($order){
            foreach ($order as $key => $value) {
                $this->database->orderBy($key, $value);
            }
        }
    }

    private function createColumnAndTableName($TableName)
    {
        $i = 0;
        foreach ($this->IEntity as $key => $value) {
            $this->Column[$i] = $key;
            $i++;
        }

        if ($TableName == null) {
            $this->TableName = $this->Extension . get_class($this->IEntity);
        } else {
            $this->TableName = $TableName;
        }

        self::createColumn();

    }

    private  function createColumn()
    {
        //  will to begin from 1 because id  be first
        for ($i = 1; $i < count($this->Column); $i++) {

            if ($i == (count($this->Column) - 1)) {
                $this->value = $this->value . "" . $this->Column[$i] . " " . "TEXT";

            } else {

                $this->value = $this->value . "" . $this->Column[$i] . " " . "TEXT" . ",";
            }

        }
    }


}