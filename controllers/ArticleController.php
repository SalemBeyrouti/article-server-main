<?php 

require(__DIR__ . "/../models/Article.php");
require_once(__DIR__ . '/../models/Category.php');
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/BaseController.php");
class ArticleController extends BaseController {
    
    public function getAllArticles(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $articles = Article::all($mysqli);
            $articles_array = ArticleService::articlesToArray($articles); 
            $this->success($articles_array);
        }

        $id = $_GET["id"];
        $article = Article::find($mysqli, $id);
        if(!$article){
            $this->error("article not found");
        }
        $this->success($article->toArray());
    }

    public function createArticle() {
        global $mysqli;

        $body = json_decode(file_get_contents("php://input"), true);

        $success = Article::create($mysqli, [
            "name" => $body["name"],
            "author" => $body["author"],
            "description" => $body["description"],
            "category_id" => $body["category_id"]
        ]);

        $success 
            ? $this->success("article created")
            : $this->error("failed to create");
        


    }

    public function updateArticle() {
        global $mysqli;

        $id = intval($_GET["id"]);

        $article = Article::find($mysqli, $id);
        if(!$article) {
           $this->error("article not found");
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $success = $article->update($mysqli, [
            "name" => $body["name"],
            "author" => $body["author"],
            "description" => $body["description"],
            "category_id" => $body["category_id"],
        ]);

        $success
            ? $this->success("article updated")
            : $this->error("failed to update");
    }

    public function deleteArticle(){
        global $mysqli;

        if (!isset($_GET["id"])) {
            $this->error("enter id");
        }

        $id = intval($_GET["id"]);
        
        $article = Article::find($mysqli, $id);
        if(!$article) {
            $this->error("article not found");
        }

        $success = Article::delete($mysqli, $id);

       $success
            ? $this-> success("article deleted")
            : $this->error("failed to delete");
    }

    public function deleteAllArticles(){
        global $mysqli;

        $success = Article::deleteAll($mysqli);

        $success
            ? $this->success("all articles deleted")
            : $this->error("failed to delete all articles");

    }


    public function getArticlesByCategory() {
        global $mysqli;

        if(!isset($_GET["id"])) {
            $this->error("enter category id");
        }

        $category_id = ($_GET["id"]);
        $articles = Article::findCategoryId($mysqli, $category_id);

        if(empty($articles)) {
            $this->error("no articles found");
        }

        $this->success(ArticleService::articlesToArray($articles));
    }


    public function getCategoryByArticle() {
        global $mysqli;

        if(!isset($_GET["id"])) {
            $this->error("article id missing");
        }

        $article_id = ($_GET["id"]);

        $article = Article::find($mysqli, $article_id);
        if(!$article) {
            $this->error("not found");

        }

        $category_id = $article->getCategoryId();
        if (!$category_id) {
            $this->error("no category assigned");
        }

        $category = Category::find($mysqli, $category_id);
        if (!$category) {
            $this->error("category not found");
        }

        $this->success($category->toArray());

    }
}

