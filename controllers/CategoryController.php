<?php 

require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/CategoryService.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/BaseController.php");

class CategoryController extends BaseController {
     public function getAllCategories(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $categories = Category::all($mysqli);
            $categories_array = CategoryService::categoriesToArray($categories); 
            $this->success($categories_array);
        }

        $id = $_GET["id"];
        $category = Category::find($mysqli, $id);
        if (!$category) {
            $this->error("article not found");
        }
        $this->success($category->toArray());
    }

    public function createCategory() {
        global $mysqli;

        $body = json_decode(file_get_contents("php://input"), true);

        $success = Category::create($mysqli, [
            "name" => $body["name"]
        ]);

        $success 
            ? $this->success("category created")
            : $this->error("failed to create");


    }

    public function updateCategory() {
        global $mysqli;

        $id = ($_GET["id"]);

        $category = Category::find($mysqli, $id);
        if(!$category) {
            $this->error("category not found");
        }
        $body = json_decode(file_get_contents("php://input"), true);
        
        $success = $category->update($mysqli, [
            "name" => $body["name"],
        ]);

        $success
            ? $this->success("category updated")
            : $this->error("failed to update");
    }


    public function deleteCategory(){
        global $mysqli;

        if(!isset($_GET["id"])) {
            echo ResponseService::error_response("enter id", 400);
            return;
        }

        $id = intval($_GET["id"]);

        $category = Category::find($mysqli, $id);
        if(!$category) {
            $this->error("category not found");
        }

        $success = Category::delete($mysqli, $id);
        
        $success
            ? $this->success("category deleted")
            : $this->error("failed to delete");
    }

    public function deleteAllCategories() {
        global $mysqli;

        $success = Category::deleteAll($mysqli);

        $success
            ? $this->success("all categories deleted")
            : $this->error("failed to delete all categories");

    }


}