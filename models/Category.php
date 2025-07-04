<?php
require_once("Model.php");

class Category extends Model{

    private int $id; 
    private string $name; 
    private string $created_at; 
    private string $updated_at; 
    
    protected static string $table = "categories";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->created_at = $data["created_at"];
        $this->updated_at = $data["updated_at"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function toArray(){
        return [$this->id, $this->name, $this->created_at, $this->updated_at];





    }

}