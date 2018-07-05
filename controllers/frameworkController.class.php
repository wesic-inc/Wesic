<?php
class frameworkController
{
    /**
     * [deleteFlashSessionAjaxAction description]
     * @return [type] [description]
     */
    public function deleteFlashSessionAjaxAction()
    {
        View::destroyFlash();
    }
    /**
     * [addFlashSessionAjaxAction description]
     * @param [type] $args [description]
     */
    public function addFlashSessionAjaxAction($args)
    {
        dump($args, 2);
        View::destroyFlash();
    }
    /**
     * [addFlashSessionAjaxAction description]
     * @param [type] $args [description]
     */
    public function dismissBlockAction(Request $request)
    {
        $param = new Setting;

        if ($request->getParam('type') == 'links') {
            $param->setParam('links-bloc', 2);
        }
        if ($request->getParam('type') == 'welcome') {
            $param->setParam('welcome-bloc', 2);
        }
    }
/**
 * [resetDashboardAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function resetDashboardAction(Request $request)
    {
        $param = new Setting;

        $param->setParam('links-bloc', 1);
        $param->setParam('welcome-bloc', 1);

        View::setFlash('Génial !', "L'affichage dashboard a bien été remis à zéro !", 'success');

        Route::redirect($request->getParam('redirect'));
    }
    /**
     * [resetDashboardAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function dashboardOrderAction(Request $request)
    {
        $param = new Setting;

        $left = explode(',', $request->getParam('left'));
        $right = explode(',', $request->getParam('right'));

        for ($i=0;$i<5;$i++) {
            if (!isset($left[$i])) {
                $param->setParam('left-'.($i+1), "NULL");
            } else {
                $param->setParam('left-'.($i+1), $left[$i]);
            }

            if (!isset($right[$i])) {
                $param->setParam('right-'.($i+1), "NULL");
            } else {
                $param->setParam('right-'.($i+1), $right[$i]);
            }
        }
    }
}
