<?php
namespace Model;
use Intervention\Image\ImageManagerStatic as Image;

class ActiveRecord
{
    protected static $db;
    protected static $colDB = [];
    protected static $tabla = ''; 



    protected static array $errors = [];


   

    public static function setDB($database)
    {
        static::$db = $database;
    }

    public function create()
    {


        $atributes = $this->sanitizeData(0);
        $services = $atributes['services'];
        unset($atributes['services']);


        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";


        static::$db->query($query) ?: header('Location: /');


        $query = "SELECT MAX(id) FROM services";
        $results = static::$db->query($query);

        $record = $results->fetch_assoc();
        $id = filter_var(intval($record['MAX(id)']), FILTER_VALIDATE_INT) ?: header('Location: /');


        $query = "INSERT INTO service (serviceID, nameService) VALUES ($id, '${services}')";
        static::$db->query($query) ?: header('Location: /');


        header('Location: /admin?state=1');
    }

    public function save()
    {
        if (($this->id) > 0) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function update()
    {

        $atributes = $this->sanitizeData(0);
        $services = $atributes['services'];

        unset($atributes['services']);
        if (empty($atributes['imageProduct'])) {
            unset($atributes['imageProduct']);
        }


        foreach ($atributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = " UPDATE services SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = " . static::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        static::$db->query($query) ?: header('Location: /error.html');



        $query = "UPDATE service SET nameService = '${services}' WHERE serviceID = ";

        $query .= static::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        static::$db->query($query) ?: header('Location: /error.html');

        header('Location: /admin?state=1');
    }


    //Identificamos cual tenemos
    public function mapAtributes(): array
    {
        $atributes = [];
        //debug(static::$colDB);
        foreach (static::$colDB as $col) {
            //debug($col);
            if ($col === 'id') continue;
            //Atributes en la posicion de col se va a llenar con los valores de la instancia 
            $atributes[$col] = $this->$col;
        }

        return $atributes;
    }

    //Sincroniza el objeto en memoria con  los nuevos cambios
    public function synchronize($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }


    public function sanitizeData(int $opt): array
    {
        $atributes = $this->mapAtributes();
        if ($opt == 1) {
            unset($atributes['email']);
        }
 
        $sanitize = [];
        

        foreach ($atributes as $key => $value) {
            if (static::$tabla == 'users') {
                $value = trim($value);
            }

            $sanitize[$key] = static::$db->escape_string($value);
        
        }
        return $sanitize;
    }

    public function setImage($image): void
    {
        if ($image) {
            $this->imageProduct = $image;
        }
    }

    public function uploadImg($image, $imgDelete)
    {
        $nameImage =  md5(uniqid(rand(), true)); 
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $completeImg = $nameImage . "." . $extension;
        if (isset($imgDelete)) {
            file_exists(FOLDER_IMG . $imgDelete) ? unlink(FOLDER_IMG . $imgDelete) : false;
        }
        
        $image = Image::make($image['tmp_name'])->fit(800, 600); //name and 
        $this->setImage($completeImg);

    
        $image->save(FOLDER_IMG . $completeImg);
    }


    public static function getErrors(): array
    {
        return static::$errors;
    }

    public static function setError($error) {
        static::$errors[] = $error;
    }

    public function validateData(): array
    {
        if (!$this->name) {
            static::$errors[] = "Title is required";
        }
        if (strlen($this->description) < 10) {
            static::$errors[] = "Description is required minimum 10 chars";
        }
        if (!$this->price > 5) {
            static::$errors[] = "Price is required";
        }
        if (!$this->services) {
            static::$errors[] = "services list is required";
        }
        if (!$this->imageProduct && $this->id == 0) {
            //debug($this->id);
            static::$errors[] = "Photo is required";
        }

        return static::$errors;
    }


    public function delete(): void
    {
        //Services all tables db
        //Delete on cascade
        $query = "DELETE FROM services WHERE id = " . static::$db->escape_string($this->id) . " LIMIT 1";

        file_exists(FOLDER_IMG . $this->imageProduct) ? unlink(FOLDER_IMG . $this->imageProduct) : false;
        static::$db->query($query) ? header('Location: /admin?state=3') : header('Location: /404.html');
    }

    public static function all(): array
    {
        $query = $query = "SELECT * FROM " . static::$tabla;
        $data = static::consulSQL($query);

        return $data; //Return all data

    }

    public static function find($id, $username)
    {   
        if (isset($username)) {
            $query = "SELECT * FROM " . static::$tabla  ." WHERE username = '${username}'";

            $data = static::consulSQL($query);
            return array_shift($data); //Devuelve primer elemento de arreglo
        }

        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";
        $data = static::consulSQL($query);

        return array_shift($data); //Devuelve primer elemento de arreglo
    }



    public static function consulSQL($query): array
    {
        $data = static::$db->query($query);
      
        $services = [];

        while ($record = $data->fetch_array(MYSQLI_ASSOC)) {
            $services[] = static::createObject($record);
        }
        $data->free(); //Liberar memoria

        return $services; //return mapp array to getect
    }

  

    protected static function createObject($record)
    { //objeto en memoria espejo de la db
        $object = new static; //new self

        foreach ($record as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value; //si existe ese objeto con esa clave
            } else if ($key == 'nameService') {
                $object->$key = $value;
            }
        }
        return $object; //return object

    }

    public static function getAny(String $col, String $table) {
        $query = "SELECT ${col} FROM ${table}";

        $data = static::$db->query($query)->fetch_all();
        
        return $data;
    }
}
