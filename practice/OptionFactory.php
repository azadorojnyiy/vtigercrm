<?php

namespace Practice;

require_once $_SERVER["DOCUMENT_ROOT"]."/practice/Option.php";

/**
 * Class OptionFactory
 * @package Practice
 */
class OptionFactory
{
    /**
     * @var array Массив ранее инициализированных объектов
     */
    protected static $repository = [];

    /**
     * @param string $category Принимает название категории
     * @return object Если в репозитории существует объект с такой категорией - возвращает объект из него, если нет -
     * создает объект и добавляет его в репозиторий
     */
    public static function build($category = null)
    {
        if (!self::$repository) {
            self::$repository[$category]= new Option($category);
        }
        return self::$repository[$category];
    }
}
