<?php

namespace Modules\Articles\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Articles\Models\Article;
use System\FileStorage;
use System\Template;

class Index extends BaseController
{
    protected $storage;

    public function __construct()
    {
        $this->storage = FileStorage::getInstance('db/articles.txt');
    }

    public function create()
    {
        $this->title = 'Create';
        $this->content = Template::render(
            __DIR__ . '/../Views/v_article_create.php', 
            ["title" => $this->title]
        );
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $art = new Article(...$_POST);
            $art->addInBD($_POST);
            exit();
        }
    }

    public function index()
    {
        $this->title = 'Home page';
        $this->content = 'Articles list';
    }

    public function item()
    {        
        $this->title = 'Article page';
        $id = (int)$this->env[1];
        $article = (new Article())->get($id);

        print_r($article);

        $this->content = Template::render(
            __DIR__ . '/../Views/v_item.php', 
            ['article' => $article]
        );


    }
}
