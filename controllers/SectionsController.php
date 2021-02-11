<?php


namespace app\controllers;

use app\core\Controller;
use app\models\Section;

class SectionsController extends Controller
{
    public function index($request)
    {
        $section = new Section();
        $section->parentID = 0;
        $params = $request->getParams();
        if(count($params) > 0 && isset($params['id'])) {
            $section->parentID = $params['id'];
        }
        $parentSectionID = $section->getByID($section->parentID)->parentID ?? 0;

        return $this->render("sections", ["sections"=>$section->getChildrens(), "parentID"=>$parentSectionID]);
    }

    public function add($request, $response)
    {
        $section = new Section();
        if($request->getMethod() === 'post')
        {
            $section->loadData($request->getBody());
            if($section->add()){
                $response->redirect('/');
                return;
            }
        }
        return $this->render("modifySection", ["sections"=>$section->makeSectionsHierarchy($section->getAll())]);
    }

    public function list($request, $response)
    {
        $section = new Section();
        return $this->render("listSections", ["sections"=>$section->getAll()]);
    }

    public function edit($request, $response)
    {

        $section = new Section();

        $params = $request->getParams();
        if(count($params) > 0 && isset($params['id'])) {
            $sectionID = $params['id'];
        }

        $currentSection = $section->getByID($sectionID);

        if($request->getMethod() === 'post')
        {
            $section->loadData($request->getBody());
            if($section->edit($sectionID)){
                $response->redirect('/');
                return;
            }
        }
        return $this->render("modifySection", ["sections"=>$section->makeSectionsHierarchy($section->getAll(), $currentSection), "section"=>$currentSection]);
    }

    public function remove($request, $response)
    {
        $params = $request->getParams();
        if(count($params) > 0 && isset($params['id'])) {
            $section = new Section();
            $section->removeRecursive($params['id']);
        }
        $response->redirect('/admin/sections/list');
    }
}