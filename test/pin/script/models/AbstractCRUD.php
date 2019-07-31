<?php


class AbstractCRUD implements TranslateInterface
{
    use TranslateTrait;

    protected static $number;
    protected static $repository = [];
    protected static $moduleInstance;
    protected static $fieldInstance = null;
    protected static $blockInstance = null;
    protected static $jsonFile = "test/script/migrations/";
    protected static $descFile = "test/script/history.log";
    protected static $descPath;
    protected static $description;
    protected static $migrationPath;
    protected static $migrationType;

    public function __construct($moduleInstance)
    {
        static::$moduleInstance = $moduleInstance;
        self::$number = date("ymd-his");
        static::setMigrationPath(self::$number);
        self::$descPath = $_SERVER["DOCUMENT_ROOT"] . "/" . static::$descFile;
    }

    protected static function getFieldInstance($fieldName)
    {
        return \Vtiger_Field_Model::getInstance($fieldName, static::$moduleInstance);
    }

    protected function getBlockInstance($name)
    {
        return \Vtiger_Block::getInstance($name, static::$moduleInstance);
    }

    public static function setOptionName($optionName, $value)
    {
        self::$fieldInstance->set($optionName, $value);
    }

    protected function getModuleInstance($moduleName)
    {
        return \Vtiger_Module_Model::getInstance($moduleName);
    }

    protected static function setMigrationPath($number)
    {
        return self::$migrationPath = $_SERVER["DOCUMENT_ROOT"] . "/" . static::$jsonFile . $number . ".json";
    }

    public function setBlock($blockLabel, $fullLabel)
    {
        $blockLabel= mb_convert_encoding($blockLabel, 'UTF-8', mb_detect_encoding($blockLabel));
        if (substr(strtoupper($blockLabel), 0, 4) == "LBL_" || $fullLabel==true) {
            $label = strtoupper($blockLabel);
        } else {
            $label = 'LBL_' . strtoupper(static::$moduleInstance->name) . "_" . strtoupper($blockLabel);
        }
        if (!$this->getBlockInstance($label)) {
            $newBlock = new \Vtiger_Block_Model();
            $newBlock->label = $label;
            static::$moduleInstance->addBlock($newBlock);
        }
        static::$repository["block"] = $blockLabel;
        static::$blockInstance = static::getBlockInstance($label);
        return self::$blockInstance;
    }

    /**
     * @param $path string путь к файлу с данными о миграции.
     * @return mixed возвращает преобразованный в ассоциативный массив json объект
     */
    protected static function getJson()
    {
        return json_decode(file_get_contents(self::$migrationPath), true);
    }

    /**
     * @param array $repository принимает массив с данными, преобразует его в json формат и записывает в файл
     */
    protected static function saveJson(array $repository)
    {
        $json = $repository;
        if (file_exists(self::$migrationPath)) {
            sleep(1);
        }
        file_put_contents(self::$migrationPath, json_encode($json, JSON_PRETTY_PRINT));
    }

    public function up()
    {
    }

    public static function down($migrationNumber)
    {
    }
    protected function get($key)
    {
        return self::$fieldInstance->get($key);
    }
    public function  __toString()
    {
        return json_encode(static::$repository, JSON_PRETTY_PRINT);
    }
    public function __invoke($key=null)
    {
        return $this->get($key);
    }
}