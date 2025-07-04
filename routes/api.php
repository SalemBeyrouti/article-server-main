<?php

return [
    '/articles'         => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],

    '/create_article'     => ['controller' => 'ArticleController', 'method' => 'createArticle'],

    '/update_article' => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
    
    '/delete_articles'         => ['controller' => 'ArticleController', 'method' => 'deleteAllArticles'],

    '/delete_article'         => ['controller' => 'ArticleController', 'method' => 'deleteArticle'],


    '/categories' => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],

    '/create_category'     => ['controller' => 'CategoryController', 'method' => 'createCategory'],

    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],

];
