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
            "events"=>$events

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


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'add-event')) {
                    $errors=["userexists"];
                } else {
                    Route::redirect('AllUsers');
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
            "errors"=> $errors
        ]);
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

        $qb = new QueryBuilder();

        $data = $qb
        ->findAll('event')
        ->addWhere('id = :id')
        ->setParameter('id', $param['id'])
        ->fetchOne();

        if (empty($data)) {
            Route::redirect('Events');
        }

        $_POST['name'] = $data['name'];
        $_POST['wesic-wysiwyg'] = html_entity_decode($data['body']);
        $_POST['place'] = $data['place'];
        $_POST['aa'] = substr($data['date'], 0, 4);
        $_POST['mm'] = substr($data['date'], 5, 2);
        $_POST['jj'] = substr($data['date'], 8, 2);
        $_POST['hh'] = substr($data['date'], 11, 2);
        $_POST['mn'] = substr($data['date'], 14, 2);
        $_POST['externalurl'] = $data['externalurl'];
        $_POST['description'] =  $data['description'];
        $_POST['image'] =  $data['image'];

        $v = new View();
        $v->setView("event/addevent", "templateadmin");
        $v->massAssign([
            "form" => $form,
            "title" => "Modifier un évenement",
            "icon" => "icon-clock",
            "errors" => $errors
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

        Route::redirect('Events');
    }
}
