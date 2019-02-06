

# Class Convert To Mysql Database Table

This artifact is class properties / database tables converter and the tables provide to use

have a class like below
<pre><code>
class Message {
    protected $Id;
    protected $Name;
}
</code></pre>

this class is implement with  IEntitiy interface for will be a database object 

<pre><code>
class Message implements IEntity {
    protected $Id;
    protected $Name;
}
</code></pre>

Create a class to access database and dress up

<pre><code>
class ClassNameDal extends DatabaseTableDao implements IDatabaseTableDao{

    private $Column;

    public function __construct()
    {
        $this->Column = parent::CreateTable(Container::getInstance(new Message()));
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


}
</code></pre>
 Columns returned from abstract class keep to <code>$Column</code> variable



<pre><code>$this->select(array("columnName => Value")) </code></pre>

like this and you can use similar methods in DatabaseTableDao.php 

also you can access to MysqliDb class methods in ClassNameDdal class


we used ThingEngineer's MysqliDb class 
Ref: https://github.com/ThingEngineer/PHP-MySQLi-Database-Class



