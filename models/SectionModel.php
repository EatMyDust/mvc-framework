<?php


namespace app\models;

use app\core\Model;

class SectionModel extends Section
{

    public $title;
    public $description;
    public $parentID;

    public function add()
    {
        if(!$this->title)
        {
            echo("No title");
            return false;
        }
        if(!$this->description)
        {
            echo("no description");
            return false;
        }

        $this->save();
    }
}