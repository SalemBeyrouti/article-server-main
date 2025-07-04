<?php

return [

    '/articles'         => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],

    '/create_article'     => ['controller' => 'ArticleController', 'method' => 'createArticle'],

    '/update_article' => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
    
    '/delete_articles'         => ['controller' => 'ArticleController', 'method' => 'deleteAllArticles'],

    '/delete_article'         => ['controller' => 'ArticleController', 'method' => 'deleteArticle'],

    '/articles_by_category' => ['controller' => 'ArticleController', 'method' => 'getArticlesByCategory'],

    

//-----------------------------------------------------------//

    '/categories' => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],

    '/create_category'     => ['controller' => 'CategoryController', 'method' => 'createCategory'],

    '/update_category' => ['controller' => 'CategoryController', 'method' => 'updateCategory'],

    '/delete_category'         => ['controller' => 'CategoryController', 'method' => 'deleteCategory'],

    '/delete_categories'         => ['controller' => 'CategoryController', 'method' => 'deleteAllCategories'],

    '/category_by_article' => ['controller' => 'ArticleController', 'method' => 'getCategoryByArticle'],

//--------------------------------------------------------------//



    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],

];
