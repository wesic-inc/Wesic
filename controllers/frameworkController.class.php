<?php
class frameworkController
{
    public function deleteFlashSessionAjaxAction()
    {
        View::destroyFlash();
    }

    public function addFlashSessionAjaxAction($args)
    {
        dump($args, 2);
        View::destroyFlash();
    }

    public function dismissBlockAction(Request $request)
    {
        $param = new Setting;

        if ($request->getParam('type') == 'links') {
            $param->setParam('links-bloc',2);
        }
        if ($request->getParam('type') == 'welcome') {
            $param->setParam('welcome-bloc',2);
        }
    }    
    public function resetDashboardAction(Request $request)
    {
        $param = new Setting;

        $param->setParam('links-bloc',1);
        $param->setParam('welcome-bloc',1);

        View::setFlash('Génial !', "L'affichage dashboard a bien été remis à zéro !", 'success');

        Route::redirect($request->getParam('redirect'));
    }
}
