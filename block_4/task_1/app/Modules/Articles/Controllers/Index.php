<?php

namespace Modules\Articles\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Articles\Models\Article;
use System\FileStorage;
use System\Template;

class Index extends BaseController
{
    protected Article $new_article;
    public function __construct()
    {
        $this->new_article = new Article();
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
        }
    }

    public function index()
    {
        $this->title = 'Home page';
        $this->content = Template::render(
            __DIR__ . '/../Views/v_item_list.php', 
            ['articles' => $this->new_article->getAll()]
        );
    }

    public function item()
    {        
        $this->title = 'Article page';
        $id = (int)$this->env[1];
        $article = $this->new_article->get($id);

        $this->content = Template::render(
            __DIR__ . '/../Views/v_item.php', 
            ['article' => $article]
        );


    }
}
