<?php

namespace Practice;

/**
 * Class AbstractOption
 * @package Practice
 */

abstract class AbstractOption
{
    /**
     * @var string $table Название таблицы в баззе данных
     */
    protected static $table ;

    /**
     * @var string $categoryField название поля в таблице  для первичной выборки
     */
    protected $categoryField;
    /**
     * @var string $categoryValue значение поля в таблице
     */
    protected $categoryValue;

    /**
     * @var \ADODB_Active_Record  $provider Объект класса Active_Record
     */
    protected $provider;
    /**
     * @var string $searchField название поля в таблице, значение которого будет выдавать геттер
     */
    protected $searchField;
    /**
     * @var string $value выдаваемое геттером значение
     */
    public $value;
    /**
     * @var string $getterKey значение принимаемое геттером
     */
    protected $getterKey;


    /**
     * AbstractOption constructor. При создании объекта класса наследника конструктор принимает параметр $category и
     * инициализирует объект класса ADODB_Active_Record и сохраняет его в параметре $provider
     * @param string $category название категории передаваемое фабрикой в класс
     */
    public function __construct($category = null)
    {
        $this->categoryValue = $category;
        $db = \PearDatabase::getInstance();
        $this->provider = new \ADODB_Active_Record(
            static::$table,
            $db->database
        );
    }

    /**
     * @return array возвращает массив объектов класса ADODB_Active_Record
     */
    protected function findRecord()
    {
        $query = $this->searchField."= ? ";
        $array=[$this->getterKey];
        if ($this->categoryValue || $this->categoryValue != "") {
            $query=$query." AND ". $this->categoryField."= ?";
            $array[]=  $this->categoryValue;
        }
        $data = $this->provider->find($query, $array);
        return $data;
    }

    /**
     *преобразует массив объектов в массив значений и присваивает этот массив в качестве значения свойства $value
     * класса наследника
     */
    protected function getValue()
    {
        $data = $this->findRecord();
        $result=[];
        foreach ($data as $arr) {
            $result[]= $arr->value;
        }
        $this->value= $result;
    }

    /**
     * @param string $key
     * @return string $value Возвращает массив значений поля value в таблице.
     * @example при обращении Option->limit вернет значение  поля value для записей в таблице, в которых поле
     * $searchfield равно limit
     */
    public function __get($key)
    {
        $this->getterKey = $key;
        $this->getValue();
        /**
         * раскомментировать строку ниже, чтобы вместо массива  возвращалась строка
         */
//        $this->value = implode(", ", $this->value);
        return $this->value;
    }
}
