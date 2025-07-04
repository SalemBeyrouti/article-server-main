<?php 

require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/CategoryService.php");
require(__DIR__ . "/../services/ResponseService.php");

class CategoryController {
     public function getAllCategories(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $categories = Category::all($mysqli);
            $categories_array = CategoryService::categoriesToArray($categories); 
            echo ResponseService::success_response($categories_array);
            return;
        }

        $id = $_GET["id"];
        $category = Category::find($mysqli, $id)->toArray();
        echo ResponseService::success_response($category);
        return;
    }

    public function createCategory() {
        global $mysqli;

        $body = json_decode(file_get_contents("php://input"), true);

        $success = Category::create($mysqli, [
            "name" => $body["name"]
        ]);

        if($success) {
            echo ResponseService::success_response("category created");
        } else {
            ResponseService::error_response("failed to create");
        }


    }

    public function updateCategory() {
        global $mysqli;

        $id = ($_GET["id"]);

        $category = Category::find($mysqli, $id);
        if(!$category) {
            ResponseService::error_response("failed to update");
            return;
        }
        $body = json_decode(file_get_contents("php://input"), true);
        
        $success = $category->update($mysqli, [
            "name" => $body["name"],
        ]);

        if($success) {
            echo ResponseService::success_response("category updated");
        } else {
            ResponseService::error_response("failed to update");
        }
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
            echo ResponseService::error_response("category not found", 400);
            return;
        }

        $success = Category::delete($mysqli, $id);
        if($success) {
            echo ResponseService::success_response("category deleted", 200);
        } else {
            echo ResponseService::error_response("failed to delete", 400);
        }
    }

    public function deleteAllCategories() {
        global $mysqli;

        $success = Category::deleteAll($mysqli);

        if($success) {
            echo ResponseService::success_response("all categories deleted", 200);
        } else {
            echo ResponseService::error_response("failed to delete", 400);
        }
    }


}