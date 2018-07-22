<?php

class mediaController
{
    public function newVideoAction(Request $request)
    {
        $post = $request->getPost();

        $form = Media::getFormNewVideo();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'videonew')) {
                    $errors=["videonew"];
                }else{
                    Route::redirect('Medias');
                }
            }
        }

        $v = new View();
        $v->setView("media/newVideo", "templateadmin");
        $v->assign("form", $form);
        $v->assign("errors", $errors);
        $v->assign("title", "Media : Vidéo");
    }


    public function newImageAction(Request $request)
    {
        $post = $request->getPost();

        $form = Media::getFormNewImage();
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'imagenew')) {
                    $errors=["imagenew"];
                } else {
                    Route::redirect('Medias');
                }
            }
        }
        
        $v = new View();
        $v->setView("media/newImage", "templateadmin");
        $v->assign("form", $form);
        $v->assign("errors", $errors);
        $v->assign("title", "Media : Image");
    }
    
    public function newMusicAction(Request $request)
    {
        $post = $request->getPost();

        $form = Media::getFormNewMusic();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);

            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'musicnew')) {
                    $errors=["musicnew"];
                } else {
                    Route::redirect('Medias');
                }
            }
        }
        
        $v = new View();
        $v->setView("media/newMusic", "templateadmin");
        $v->assign("form", $form);
        $v->assign("errors", $errors);
        $v->assign("title", "Media : Musique");
    }

    public function allMediasAction(Request $request)
    {
        $param = $request->getParams();
        $get = $request->getGet();

        $qbMedias = new QueryBuilder();
        $qbMedias->all("media");
        
        if (isset($param['filter'])) {
            $filter = $param['filter'];
            $qbMedias->mediaDisplayFilters($filter);
        } else {
            $filter = null;
        }

        if (isset($get['s'])) {
            $search = $get['s'];
            $qbMedias->all('media')
            ->search('name', $search)
            ->or()
            ->search('description', $search)
            ->or()
            ->search('caption', $search);
        }

        $medias = $qbMedias->paginate(24);
        
        
        $v = new View();
        $v->setView("media/medias", "templateadmin");
        $v->assign("medias", $medias);
        $v->assign("title", "Medias");
        $v->assign("filter", $filter);
        $v->assign("mediaType", ['image' => '1', 'video' => '2', 'music' => '3']);
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
            $images = $qb->all('media')->where('type', 1)->paginate(12, $request->getParam('p'));

            $v = new View();
            $v->setView("ajax/images-modal", "templateajax")
            ->massAssign([
                "images"=>$images,
            ]);
        }
    }
    public function editMediaAction(Request $request)
    {

        $post = $request->getPost();
        $param = $request->getParams();
        $mediaType = $param['type'];

        $qb = new QueryBuilder();
        $v = new View();
        $errors = [];
        $pageTitle = '';
        $validatorCheck = '';

        switch ($mediaType) {
            case 1:
            $form = Media::getFormEditImage();
            $validatorCheck = 'edit-image-media';
            break;
            
            case 2:
            $form = Media::getFormEditVideo();
            $validatorCheck = 'edit-video-media';
            break;

            case 3:
            $form = Media::getFormEditMusic();
            $validatorCheck = 'edit-music-media';
            break;
            default:
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request->setPost('id', $param['id']);

            $errors = Validator::check($form["struct"], $request->getPost());

            if (!$errors) {
                if (!Validator::process($form["struct"], $request->getPost(), $validatorCheck)) {
                    $errors=[$validatorCheck];
                } else {
                    Route::redirect('Medias');
                }
            }
        }

        $data = $qb->all('media')->where('id', $param['id'])->fetchOrFail();

        $_POST['name'] = $data['name'];
        $_POST['description'] = $data['description'];

        switch ($mediaType) {
            case 1:
            $_POST['caption'] = $data['caption'];
            $_POST['alttext'] = $data['alttext'];
            $_POST['path'] = $data['path'];

            $pageTitle = "Modification d'une image";
            break;
            
            case 2:
            $_POST['url'] = $data['url'];
            $pageTitle = "Modification d'une vidÃ©o";
            break;

            case 3:
            $_POST['caption'] = $data['caption'];
            $_POST['alttext'] = $data['alttext'];
            $_POST['path'] = $data['path'];

            $pageTitle = "Modification d'une musique";
            break;
            default:
        }

        $v->setView("media/editMedia", "templateadmin");

        $v->massAssign([
            "type"=> $data['type'],
            "path"=> $data['path'],
            "url"=> $data['url'],
            "form"=>$form,
            "title" => $pageTitle,
            "icon" => "icon-pen",
            "errors" => $errors
        ]);
    }
}
