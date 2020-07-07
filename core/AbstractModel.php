<?php
namespace Core;

use PDO;

class AbstractModel
{
   const TABLE_NAME = '';
   public $fields;
   public $id = null;

   public function __construct(array $fields = null)
   {
       $this->fields = $fields;
   }

   public function save()
   {
       if (empty($this->fields))
           return false;

       if (!$this->id) {
           $stmt = App::$db->prepare(
               "INSERT INTO 
                            ".static::TABLE_NAME." 
                            (" . implode(", ", array_keys($this->fields)) . ") 
                            VALUES (" . implode(", ", array_map(function ($el) {
                   return ':' . $el;
               }, array_keys($this->fields))) . ");"
           );
       } else
           $stmt = App::$db->prepare(
               "UPDATE ".static::TABLE_NAME."
                                SET  
                                " . implode(", ", array_map(function ($el) {
                                    return "$el = :$el";
                   return ':' . $el;
               }, array_keys($this->fields))) ."
               WHERE id={$this->id};"
            );

       return $stmt->execute($this->fields);
   }

   public static function findAll()
   {
       $stmt = App::$db->prepare("SELECT * FROM ".static::TABLE_NAME);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

public static function findOne($id) : AbstractModel
   {
       $stmt = App::$db->prepare("SELECT *  FROM ".static::TABLE_NAME." WHERE id=:id LIMIT 1");
       $stmt->execute([':id' => $id]);

       if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $calledClass = get_called_class();

           $myClass = new $calledClass;
           $myClass->id = $id;
           $myClass->fields = $data;

           return $myClass;
       }

       return null;
   }

   public function delete()
   {
       App::$db->exec("DELETE FROM ".static::TABLE_NAME." WHERE id=".$this->id);
   }
}