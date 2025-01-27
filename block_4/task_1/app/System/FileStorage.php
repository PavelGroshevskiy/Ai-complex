<?php

namespace System;

use Exception;
use System\Contracts\IStorage;

class FileStorage implements IStorage
{
    protected array $records = [];
    protected int $ai = 0;
    protected string $dbPath;
    protected static array $instances = [];

    public static function getInstance($dbPath) : self
    {
        if(!isset(self::$instances[$dbPath])) {
            self::$instances[$dbPath] = new self($dbPath);
        }

        return self::$instances[$dbPath];
    }

    protected function __construct(string $dbPath)
    {
        $this->dbPath = $dbPath;

        if (file_exists($this->dbPath)) {
            $data = json_decode(file_get_contents($this->dbPath), true);
            $this->records = $data['records'];
            $this->ai = $data['ai'];
        } else {
            throw new Exception('Отсутствует файл БД');
        }
    }
}
