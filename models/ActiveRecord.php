<?php

namespace Model;

use Intervention\Image\ImageManagerStatic as Image;

class ActiveRecord
{
    protected static $db;
    protected static $colDB = [];
    protected static $tabla = '';



    protected static array $alerts = [];




    public static function setDB($database)
    {
        static::$db = $database;
    }

    public function create()
    {

        $atributes = $this->sanitizeData();



        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";
        return static::$db->query($query);
    }

    public function save()
    {
        
        if (($this->id) > 0) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function update()
    {

        $atributes = $this->sanitizeData(0);

        if (empty($atributes['imageProduct'])) {
            unset($atributes['imageProduct']);
        }


        foreach ($atributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = " . static::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        return static::$db->query($query);
    }


    //Identificamos cual tenemos
    public function mapAtributes(): array
    {
        $atributes = [];
        foreach (static::$colDB as $col) {
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


    public function sanitizeData(): array
    {
        $atributes = $this->mapAtributes();

        $sanitize = [];

        foreach ($atributes as $key => $value) {
            if (!is_bool($value)) {
                $sanitize[$key] = static::$db->escape_string($value);
            } else {
                $sanitize[$key] = $value;
            }
           
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


    public static function getAlerts(): array
    {
        return static::$alerts;
    }

    public static function setAlert($alert)
    {
        static::$alerts[] = $alert;
    }

    public function validateData()
    {
       
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

    public static function find($col, $item)
    {

        $query = "SELECT * FROM " . static::$tabla  . " WHERE ${col} = '${item}'";
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

    public static function getAny(String $col, String $table)
    {
        $query = "SELECT ${col} FROM ${table}";

        $data = static::$db->query($query)->fetch_all();

        return $data;
    }
}
