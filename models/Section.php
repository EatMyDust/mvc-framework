<?php

namespace app\models;

class Section extends \app\core\DatabaseModel
{
    public $id = 0;
    public $name = '';
    public $description = '';
    public $parentID = 0;

    public function tableName()
    {
        return 'sections';
    }

    public function attributes()
    {
        return ['name', 'description', 'parentID'];
    }

    public function add()
    {
        return parent::save();
    }

    public function edit($id)
    {
        return parent::update($id);
    }

    public function removeRecursive($id)
    {
        foreach($this->getAll(['parentID'=>$id]) as $section) {
            $this->removeRecursive($section->id);
        }
        return parent::remove(['id'=>$id]);
    }

    public function getChildrens()
    {
        return parent::findAll(['parentID' => $this->parentID]);
    }

    public function getAll($where = [1=>1])
    {
        return parent::findAll($where);
    }

    public function getByID($id)
    {
        return parent::findOne(['id' => $id]);
    }

    public function makeSectionsHierarchy(array $sections, $currentSection = [], $parentID = 0, $depth = 0) {
        $branch = array();
        foreach ($sections as $section) {
            if ($section->parentID == $parentID) {
                $section->depth = $depth;
                if($currentSection) {
                    if ($section->id == $currentSection->id) $section->current = true;
                    if ($section->id == $currentSection->parentID) $section->selected = true;
                }
                $children = $this->makeSectionsHierarchy($sections, $currentSection, $section->id, $depth+1);
                if ($children) $section->children = $children;
                $branch[] = $section;
            }
        }
        return $branch;
    }


    public static function makeSectionsTree(array $sections, $separator = '.') {
        $return = "";
        foreach ($sections as $section) {
            if($section->current) continue;
            $selected = $section->selected ? 'selected=selected':'';
            $return .= "<option value=".$section->id." ".$selected.">".str_repeat($separator, $section->depth+1).$section->name."</option>";
            if (isset($section->children) && sizeof($section->children)) {
                $return .= self::makeSectionsTree($section->children);
            }
        }
        return $return;
    }
}