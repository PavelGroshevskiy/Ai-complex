<?php

namespace Modules\Articles\Models;

use Exception;
use System\Contracts\IStorage;
use System\FileStorage;

class Article extends FileStorage
{
    protected IStorage $storage;
   
    public function __construct(
        protected ?string $title = '',
        protected ?string $content = ''
    ) {
        $this->storage = FileStorage::getInstance('db/articles.txt');
    }

    public function addInBD($fields)
    {
        if ($this->storage->ai < 10) {
            $id = ++$this->storage->ai;
            $this->storage->records[$id] = $fields;
            $this->save();
            return $id;
        } else {
            throw new Exception('Статей максимум 10');
        }
    }

    protected function save()
    {
        file_put_contents(
            $this->storage->dbPath, json_encode(
                [
                'records' => $this->storage->records,
                'ai' => $this->storage->ai
                ]
            )
        );
    }

    public function get(int $id) : ?array
    {
        if (isset($this->storage->records[$id])) {
            $record = $this->storage->records[$id];
            return $record;
        } else {
            throw new Exception('Не существует статьи');

        }

    }
    public function getAll() : ?array
    {
        if (isset($this->storage->records)) {
            return $this->storage->records;
        } else {

            throw new Exception('НеТ статей');

        }

    }

}