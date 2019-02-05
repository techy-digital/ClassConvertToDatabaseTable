<?php
/**
 * Created by PhpStorm.
 * User: muzaffer
 * Date: 01.02.2019
 * Time: 15:08
 */
include_once ROOT_PATH.'/entities/concrete/Message.php';
include_once ROOT_PATH.'/entities/abstract/Container.php';
include_once ROOT_PATH.'/data/abstract/DatabaseTableDao.php';
include_once ROOT_PATH.'/data/abstract/IDatabaseTableDao.php';

class ExampleDal extends DatabaseTableDao implements IDatabaseTableDao
{

    private $Rows;

    public function __construct()
    {
        $this->Rows = parent::CreateTable(Container::getInstance(new Message()));
    }

    public function getMessageToId($id)
    {
        if ($id) {
            return $this->select(
                array(
                    'Id' => $id
                )
            );
        } else
            return false;
    }

    public function getAllMessagesToUserId($UserId, $HowManyMessage = null)
    {
        if ($UserId) {
            return $this->selectAll(
                array(
                    'UserId' => $UserId
                )
                , $HowManyMessage);
        } else
            return false;
    }
}