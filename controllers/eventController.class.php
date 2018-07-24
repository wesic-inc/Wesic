<?php
class eventController
{

    /**
     * [allEventsAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function allEventsAction(Request $request)
    {
        $param = $request->getParams();
        $get = $request->getGet();
        $filter = null;
        $sort = null;

        $qbEvents = new QueryBuilder();
        $qbEvents->all('event');

        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qbEvents->and()->where('date', '<', date("Y-m-d"));
        }
        if (isset($param['sort'])) {
            $sort = $param['sort'];
            $qbEvents->eventDisplaySorting($sort);
        }
        if (isset($get['s'])) {
            $search = $get['s'];
            $qbEvents->and()->search('name', $search);
        }        

        $events = $qbEvents->paginate(10);

        $v = new View();

        $v->setView("cms/events", "templateadmin");
        $v->massAssign([
            "title"=>"Tous les évenements",
            "icon"=>"icon-alarm",
            "filter"=>$filter,
            "elementNumber"=>$events['pagination']['total'],
            "events"=>$events,
            "sort"=>$sort

        ]);
    }
    /**
     * [addEventAction description]
     * @param Request $request [description]
     */
    public function addEventAction(Request $request)
    {
        $form = Event::getFormNewEvent();
        $errors = [];

        $post = $request->getPost();
        
        $qbMedias = new QueryBuilder();
        $images = $qbMedias->all('media')->where('type', 1)->paginate(12);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'add-event')) {
                    $errors=["userexists"];
                } else {
                    Route::redirect('Events');
                }
            }
        }

        $v = new View();
        $v->setView("event/addevent", "templateadmin");
        $v->massAssign([
            "page"=>"adduser",
            "title"=> "Ajouter un évenement",
            "icon"=> "icon-clock",
            "form"=> $form,
            "errors"=> $errors,
            "images" => $images
        ]);
    }

        public function eventActionsAction(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectIds = json_decode($request->getPost()['ids']);
            switch ($request->getParam('action')) {
                case 'delete':
                    foreach ($selectIds as $val) {
                        Event::deleteEvent($val);
                    }
                    break;
                default:
                    break;
            }
        } else {
            Route::redirect('Error404');
        }
    }

    public function editEventAction($args)
    {
        $form = Event::getFormEditEvent();
        $errors = [];

        $param = $args->getParams();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $args->getPost());
            if (!$errors) {
                $val = $args->getPost();
                $val['id'] = $param['id'];
                if (!Validator::process($form["struct"], $val, 'edit-event')) {
                    $errors=["eventexists"];
                } else {
                    Route::redirect('Events');
                }
            }
        }

        $qbMedias = new QueryBuilder();
        $images = $qbMedias->all('media')->where('type', 1)->paginate(12);


        $qb = new QueryBuilder();

        $data = $qb
        ->findAll('event')
        ->where('id',$param['id'])
        ->fetchOrFail();



        $_POST['name'] = $data['name'];
        $_POST['place'] = $data['place'];
        $_POST['aa'] = substr($data['date'], 0, 4);
        $_POST['mm'] = substr($data['date'], 5, 2);
        $_POST['jj'] = substr($data['date'], 8, 2);
        $_POST['hh'] = substr($data['date'], 11, 2);
        $_POST['mn'] = substr($data['date'], 14, 2);
        $_POST['externalurl'] = $data['externalurl'];
        $_POST['description'] =  $data['description'];
        $_POST['feature-image-input'] = $data['featured'];
        $_POST['featured'] = $data['featured'];


        $v = new View();
        $v->setView("event/addevent", "templateadmin");
        $v->massAssign([
            "form" => $form,
            "title" => "Modifier un évenement",
            "icon" => "icon-clock",
            "errors" => $errors,
            "images" => $images
        ]);
    }
    /**
     * [deleteEventAction description]
     * @param  [type] $args [description]
     * @return [type]       [description]
     */
    public function deleteEventAction($args)
    {
        $param = $args->getParams();

        Event::deleteEvent($param['id']);
        
        View::setFlash("Succès !", "L'événement a bien été supprimé", "success");
        
        Route::redirect('Events');
    }
}
