
Class Convert To Mysql Database Table

Php Oluşturulan sınıfları database tablosuna dönüştüren ve bunlara kullanmaya olanak sağlayan yapı.

Bir tabloya erişim sağlamak için aşağıdaki gibi sınıfımız olduğunu varsayalım.

//CODE
class Message {
    private $Id;
    private $Name;
}

Bu sınıfın bir database nesnesi olacağını belirtmek için IEntity arayüzü ile sarmalıyoruz.

//CODE
class Message implements IEntity {
    private $Id;
    private $Name;
}

Sonrasında database'e erişim sağlayacak sınıfımızı oluşturalım ve bunları aşağıdaki gibi sarmayalım.

//CODE
class ClassNameDal extends extends DatabaseTableDao implements IDatabaseTableDao{

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


}

Abstract sınıftan dönen satır adlarınıda $Rows değişkeninde tutmuş olacağız.

DatabaseTableDao.php adlı dosyanın içerisindeki
Abstract sınıfının içerisinde $this->select(array("RowsName => Value")) şeklinde
ve buna benzer methodlarıda kullanabiliriz


Ayrıca ClassNameDal Sınıf içerisinden MysqliDb sınıfınında methodlarına erişim sağlanılabilir.


ThingEngineer'in MysqliDb sınıfı kullanılmış.
Referans: https://github.com/ThingEngineer/PHP-MySQLi-Database-Class


