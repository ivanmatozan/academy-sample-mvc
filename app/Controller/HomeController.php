<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\Post;
use App\Model\Post\PostRepository;

class HomeController extends AbstractController
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        parent::__construct();
    }

    public function indexAction(): string
    {
        return $this->view->render('home', [
            'posts' => Post::getAll(),
        ]);
    }
}
