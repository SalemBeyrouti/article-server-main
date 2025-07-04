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


}