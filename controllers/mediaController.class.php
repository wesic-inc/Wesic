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
            $qb = new QueryBuilder();
            $medias = $qb->all('media')->paginate(24,$request->getParam('p'));

            $v = new View();
            $v->setView("ajax/medias-modal", "templateajax")->assign("medias", $medias);
        }
    }
}
