<?php

namespace Model;

use DateTime;
use Intervention\Image\ImageManagerStatic as Image;

class ActiveRecord
{
    protected static $db;
    protected static $colDB = [];
    protected static $tabla = '';



    protected static array $alerts = [];




    public static function sanitizeAny($data)
    {
        static::$db->escape_string($data);
    }

    public static function setDB($database)
    {
        static::$db = $database;
    }


    /**
     * @return [type]
     */
    public function create()
    {

        $atributes = $this->sanitizeData();


        if (array_key_exists('create_at', $atributes)) {
            unset($atributes['create_at']);
        }



        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";

        return static::$db->query($query);
    }

    /**
     * @return boolean
     */
    public function save()
    {

        if (($this->id) > 0) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    /**
     * @return [boolean]
     */
    public function update()
    {

        $atributes = $this->sanitizeData();

        if (array_key_exists('gen', $atributes)) {
            unset($atributes['gen']);
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
    /**
     * @return array
     */
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


    /**
     * @return array
     */
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

    /**
     * @param mixed $image
     * 
     * @return void
     */
    public function setImage($image): void
    {
        if ($image) {
            $this->avatar = $image;
        }
    }

    /**
     * @param mixed $image
     * @param mixed $imgDelete
     * @param bool $isProfile
     * 
     * @return [type]
     */
    public function uploadImg($image, $imgDelete, bool $isProfile)
    {



        $nameImage =  md5(uniqid(rand(), true));
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $completeImg = $nameImage . "." . $extension;
        if (isset($imgDelete)) {
            file_exists(FOLDER_IMG . $imgDelete) ? unlink(FOLDER_IMG . $imgDelete) : false;
        }

        $image = Image::make($image['tmp_name'])->fit(300, 300); //name and 
        $this->setImage($completeImg);

        $image->save(FOLDER_IMG . $completeImg);
        if ($isProfile) {
            $_SESSION['avatar'] = $completeImg;
        }
    }


    /**
     * @return array
     */
    public static function getAlerts(): array
    {
        return static::$alerts;
    }

    /**
     * @param mixed $alert
     * 
     * @return [type]
     */
    public static function setAlert($alert)
    {
        static::$alerts[] = $alert;
    }




    public static function deleteAny($query)
    {
        return static::$db->query($query);
    }


    /**
     * @return bool
     */
    public function delete(): bool
    {
        //Services all tables db
        //Delete on cascade
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . static::$db->escape_string($this->id) . " LIMIT 1";

        if ($this instanceof Users) {
            file_exists(FOLDER_IMG . $this->avatar) ? unlink(FOLDER_IMG . $this->avatar) : false;
        }
        return static::$db->query($query);
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        $query = $query = "SELECT * FROM " . static::$tabla;
        $data = static::consulSQL($query);

        return $data; //Return all data

    }

    /**
     * @return int
     */
    public static function getLastId(): int
    {
        return static::$db->insert_id;
    }

    /**
     * @param mixed $date
     * 
     * @return [type]
     */
    public static function validateDate($date)
    {
        $format = 'Y-m-d H:i:s';
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }



    /**
     * @param mixed $col
     * @param mixed $item
     * @param bool $isAll
     * 
     * @return [type]
     */
    public static function find($col, $item, bool $isAll)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE ${col} = '${item}' ";

        $data = static::consulSQL($query);

        if ($isAll) {
            return $data;
        }
        return array_shift($data); //Devuelve primer elemento de arreglo
    }

    /**
     * @param mixed $col
     * @param mixed $item
     * @param bool $isAll
     * 
     * @return array
     */
    public static function findLike($col, $item, bool $isAll)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE ${col} LIKE  '%$item%' ";


        $data = static::consulSQL($query);

        if ($isAll) {
            return $data;
        }

        return array_shift($data); //Devuelve primer elemento de arreglo
    }



    /**
     * @param mixed $query
     * 
     * @return array
     */
    public static function consulSQL($query): array
    {
        $data = static::$db->query($query); //puede dar false 

        $services = [];

        if ($data) {
            while ($record = $data->fetch_array(MYSQLI_ASSOC)) {
                $services[] = static::createObject($record);
            }
            $data->free(); //Liberar memoria
        }


        return $services; //return mapp array to getect
    }



    /**
     * @param mixed $record
     * 
     * @return object
     */
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

    /**
     * @param mixed $attributes
     * 
     * @return bool
     */
    public  function validateAttributes($attributes): bool
    {
        foreach ($attributes as $key => $value) {
            if ($key != 'repeatPassword' && $key != 'members') {
                //$this->$key = trim($value); DESCOMENTAR EN CASO DE FALLO


                if ($key == 'password') {
                    if (strlen($this->$key) < 8) {
                        static::$alerts[] = 'La contraseña debe tener minimo 8 carácteres';
                    }
                    if (array_key_exists('repeatPassword', $attributes)) {
                        $repeatPassword = trim($attributes['repeatPassword']);

                        if ($repeatPassword != $this->password) {
                            static::$alerts[] = 'No coinciden las contraseñas';
                        }
                    }
                }

                if ($key == 'new_password' && strlen($value) > 0) { //confirm_new_password
                    if (trim($value) != trim($attributes['confirm_new_password'])) {
                        static::$alerts[] = 'No coinciden las contraseñas';
                    }
                }

                if ($key == 'username') {
                    if (strlen($this->$key) < 5) {
                        static::$alerts[] = 'Tu usuario debe tener minimo 5 carácteres';
                    }
                }
            }
            if ($key == 'name') {
                if (strlen($this->$key) < 1) {
                    static::$alerts[] = 'El nombre no puede ir vacio';
                }
            }

            if ($key == 'apellidos') {
                if (strlen($this->$key) < 1) {
                    static::$alerts[] = 'Los apellidos no pueden ir vacios';
                }
            }

            if ($key == 'description') {
                if (strlen($this->$key) < 1) {
                    static::$alerts[] = 'La descripcion no puede ir vacia';
                }
            }

            if ($key == 'content') {

                if (strlen($this->$key) < 1) {
                    static::$alerts[] = 'El contenido no puede ir vacia';
                }
            }
        }
        return empty(static::$alerts);
    }

    /**
     * @param String $table
     * 
     * @return array
     */
    public function getAnyAll(String $table): array
    {
        $query = "SELECT * FROM $table";
        return static::consulSQL($query);
    }

    /**
     * @param mixed $query
     * 
     * @return [type]
     */
    public static function insertAny($query)
    {
        return static::$db->query($query);
    }

    /**
     * @param mixed $query
     * 
     * @return [type]
     */
    public static function getAnyQuery($query)
    {
        return static::$db->query($query)->fetch_assoc();
    }

    /**
     * @param mixed $query
     * 
     * @return array
     */
    public static function getAnyQueryResult($query)
    {
        $data_res = [];
        //echo json_encode(Users::getAnyQuery($query));

        $data = static::$db->query($query);
        if ($data) {
            while ($record = $data->fetch_array(MYSQLI_ASSOC)) {
                $data_res[] = $record;
            }
            $data->free(); //Liberar memoria
        }


        return $data_res;
    }
}
