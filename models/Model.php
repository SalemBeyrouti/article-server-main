<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }

        return $objects; //we are returning an array of objects!!!!!!!!
    }

    public static function create(mysqli $mysqli, array $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", static::$table, $columns, $placeholders);

        $stmt = $mysqli->prepare($sql);
        if(!$stmt) return false;

        $types = str_repeat("s", count($data));
        $values = array_values($data);

        $stmt->bind_param($types, ...$values);

        return $stmt->execute();

    }

    public function update(mysqli $mysqli, array $data){
        $sql = "UPDATE " . static::$table . " SET name = ?, author = ?, description = ?, category_id = ? WHERE " . static::$primary_key . " = ?";

        $stmt = $mysqli->prepare($sql);
        if(!$stmt) return false;

        $stmt->bind_param(
            "ssssi",
            $data["name"],
            $data["author"], $data["description"], $data["category_id"], $this->id
        );

        return $stmt->execute();
    }

    public static function delete(mysqli $mysqli, int $id) {
        $sql = sprintf("DELETE FROM %s WHERE %s = ?", static::$table, static::$primary_key);

        $stmt = $mysqli->prepare($sql);
        if(!$stmt) return false; 
        $stmt ->bind_param("i", $id);

        return $stmt->execute();


    }

    public static function deleteAll(mysqli $mysqli) {
        $sql = sprintf("DELETE FROM %s", static::$table);

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) return false;

        return $stmt->execute();
    }


    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
}



