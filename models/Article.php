<?php
require_once("Model.php");

class Article extends Model{

    protected int $id; 
    private string $name; 
    private string $author; 
    private string $description; 

    private ?int $category_id;
    
    protected static string $table = "articles";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->author = $data["author"];
        $this->description = $data["description"];
        $this->category_id = $data["category_id"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCategoryId(): ?int {
        return $this->category_id;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setAuthor(string $author){
        $this->author = $author;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function setCategoryId(int $category_id){
        $this->category_id = $category_id;
    }



    public function toArray(){
        return [$this->id, $this->name, $this->author, $this->description, $this->category_id];
    }


    public static function findCategoryId(mysqli $mysqli, int $category_id) {

        $sql = "SELECT * FROM articles WHERE category_id = ?";

        $stmt = $mysqli->prepare($sql);

        if(!$stmt) return [];

        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];

        while ($row = $result->fetch_assoc()) {
            $articles[] = new static($row);
        }

        return $articles;


    }
    
}
