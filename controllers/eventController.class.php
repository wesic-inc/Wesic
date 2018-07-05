<?php
class eventController{

/**
 * [indexAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
	public function indexAction(Request $request){

		$params = $request->getParams();

		$v = new View();
		$v->setView("event/index","templateadmin")->massAssign(["title"=>"Evenements","icon"=>"icon-alarm"]);

	}
/**
 * [allEventsAction description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
	public function allEventsAction(Request $request){

		$param = $request->getParams();
		$get = $request->getGet();
		$filter = null;
		$sort = null;

		$qbEvents = new QueryBuilder();
		$qbEvents->all('event');

		$events = $qbEvents->paginate(10);

		$v = new View();

		$v->setView("cms/events", "templateadmin");
		$v->massAssign([
			"title"=>"Tous les évenements",
			"icon"=>"icon-alarm",
			"filter"=>$filter,
			"elementNumber"=>Singleton::request()->getPaginate()['total'],
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
				if (!Validator::process($form["struct"], $post, 'add-user')) {
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

}