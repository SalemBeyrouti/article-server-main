<?php

return [
    '/articles'         => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],
    '/create_article'     => ['controller' => 'ArticleController', 'method' => 'createArticle'],
    '/update_article' => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
    '/delete_articles'         => ['controller' => 'ArticleController', 'method' => 'deleteAllArticles'],

    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],

];
