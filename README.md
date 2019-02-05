

# Class Convert To Mysql Database Table

Php Oluşturulan sınıfları database tablosuna dönüştüren ve bunlara kullanmaya olanak sağlayan yapı.
Bir tabloya erişim sağlamak için aşağıdaki gibi sınıfımız olduğunu varsayalım.

<pre><code>
class Message {
    protected $Id;
    protected $Name;
}
</code></pre>

Bu sınıfın bir database nesnesi olacağını belirtmek için IEntity arayüzü ile sarmalıyoruz.
<pre><code>
class Message implements IEntity {
    protected $Id;
    protected $Name;
}
</code></pre>
Sonrasında database'e erişim sağlayacak sınıfımızı oluşturalım ve bunları aşağıdaki gibi sarmayalım.

<pre><code>
class ClassNameDal extends extends DatabaseTableDao implements IDatabaseTableDao{

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
Abstract sınıftan dönen sütun adlarınıda $Column değişkeninde tutmuş olacağız.

DatabaseTableDao.php adlı dosyanın içerisindeki
Abstract sınıfının içerisinde
<pre><code>$this->select(array("columnName => Value")) </code></pre>

şeklinde ve buna benzer methodlarıda kullanabiliriz


Ayrıca ClassNameDal Sınıf içerisinden MysqliDb sınıfınında methodlarına erişim sağlanılabilir.


ThingEngineer'in MysqliDb sınıfı kullanılmış.
Referans: https://github.com/ThingEngineer/PHP-MySQLi-Database-Class

