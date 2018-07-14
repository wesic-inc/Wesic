<?php

class mediaController
{
    /**
     * [indexAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function indexAction($args)
    {
        $v = new View();
        $v->setView("media/medias", "templateadmin")->massAssign(["title"=>"Médias","icon"=>"icon-images"]);
    }

    public function modalPaginationAjaxAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $paginationInfos = json_decode($request->getPost()['pagination']);
            
            if (!empty($request->getPost()['selected'])) {
                $selected = json_decode($request->getPost()['selected']);
            } else {
                $selected = [];
            }

            $qb = new QueryBuilder();
            $medias = $qb->all('media')->paginate(24, $request->getParam('p'));

            $v = new View();
            $v->setView("ajax/medias-modal", "templateajax")
            ->massAssign([
                "medias"=>$medias,
                "selected"=>$selected
            ]);
        }
    }    
    public function modalImagePaginationAjaxAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $paginationInfos = json_decode($request->getPost()['pagination']);

            $qb = new QueryBuilder();
            $images = $qb->all('media')->where('type',1)->paginate(12, $request->getParam('p'));

            $v = new View();
            $v->setView("ajax/images-modal", "templateajax")
            ->massAssign([
                "images"=>$images,
            ]);
        }
    }
}
