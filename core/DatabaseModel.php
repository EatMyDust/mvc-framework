<?php


namespace app\core;


abstract class DatabaseModel extends Model
{
    abstract public function tableName();

    abstract public function attributes();


    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchObject();
    }

    public static function findAll($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(', ',$attributes).") VALUES(".implode(', ',$params).")");
        foreach ($attributes as $attribute)
        {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }

    public function update($id)
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $sql = implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("UPDATE $tableName SET ".$sql." WHERE id=".$id);
        foreach ($attributes as $attribute)
        {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }

    public function remove($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
        foreach ($where as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return true;
    }



    public function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }


}