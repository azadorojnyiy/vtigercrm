<?php
/*общий срок выполнения задачи 5 часов 45 минут. Из них:
1час 15 минут - разбирался с подключением классов в тайгер
35 минут - проблема с корректностью пути к зависимостям в подключаемых файлах
3 часа 10 минут чтение документации по ADODB и тестирование работы методов
20минут - написание итогового кода
15 минут создание таблицы в бд и проверка корректности получения данных из нее
10минут - итоговое тестирование работоспособности кода и корректности вывода информации
*/
chdir($_SERVER["DOCUMENT_ROOT"]);
require_once "libraries/adodb/adodb-active-recordx.inc.php";
require_once "config.inc.php";

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once 'include/database/PearDatabase.php';

//базовый класс
class Options
{
    protected $object;
    protected $category;

    function __construct($provider, $category=null)
   {
       $this->object = $provider;
       $this->category = $category;
   }

   //принимает значение запрашиваемого свойства объекта в качестве ключа для поиска по полю keyword
   public function __get($key)
   {
       //если при создании объекта  передается значение поля "category" для фильтрации вывода, то выводит конкретное
       // значение поле value, иначе выводит массив значение
       if(!$this->category){
           $data = $this->object->find("keyword='".$key."'");
           $result =array ();
          foreach ($data as $arr)
          {
              array_push($result,  $arr->value);
          };
//          Расскоментировать следующую строку, чтобы вывести массив значений в виде строки
//          $result =  implode(", ", $result);
          return $result;
       }else{
       $result = $this->object->find("keyword='".$key."' AND category='".$this->category."'");
        return $result[0]->value;
       }
   }
}

//принимает значение поля category, создает объект класса ADODB_Active_Record и инициализирует создание нового
//объекта класса Option, в который передает значение поля category и созданный объект
    class OptionsFactory
    {
        static $table="vtiger_options";

        static function build($category=null)
        {
            $db = PearDatabase::getInstance();
            $provider = new ADOdb_Active_Record(
                self::$table,
                $db->database
            );
            return new Options($provider, $category);
        }
}

$cat1Options = OptionsFactory::build('cat2');

echo $cat2Options->limit;