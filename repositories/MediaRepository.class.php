<?php

class MediaRepository extends Basesql
{
    public static function extractYoutubeId($url)
    {
        $beginExtract =  'watch?v=';
        return substr($url, strpos($url, $beginExtract) + strlen($beginExtract));
    }

    public static function newVideo($data)
    {
        $media = new Media();
        $media->setName($data['name']);
        $media->setType(2);
        $media->setDescription($data['description']);
        $media->setUrl(self::extractYoutubeId($data['url-yt']));
        $media->setUserId(Auth::id());
        $media->save();

        View::setFlash("Succès !", "La vidéo a bien été enregistrée", "success");
        

        return true;
    }

    public static function newImage($data)
    {
        $media = new Media();
        if (isset($data['id'])) {
            $media->setId($data['id']);
        }
        $media->setName($data['name']);
        $media->setType(1);
        $media->setDescription($data['description']);
        $media->setCaption($data['caption']);
        $media->setAlttext($data['alttext']);
        $media->setUserId(Auth::id());
        $media->setPath(self::uploadFileReturnPath('img', $_FILES['image']));
        $media->save();

        View::setFlash("Succès !", "L'image a bien été enregistrée", "success");

        return true;
    }


    public static function newMusic($data)
    {
        $media = new Media();



        $media->setName($data['name']);
        $media->setType(3);
        $media->setDescription($data['description']);
        $media->setCaption($data['caption']);
        $media->setUserId(Auth::id());
        $media->setPath(self::uploadFileReturnPath('music', $_FILES['music']));
        $media->save();

        View::setFlash("Succès !", "La musique a bien été enregistrée", "success");

        return true;
    }

    public static function uploadFileReturnPath($type, $file)
    {
        $extension = "";
        
        if ($type == 'img') {
            switch ($file['type']) {
                case 'image/jpeg':
                $extension = ".jpeg";
                break;
                case 'image/jpg':
                $extension = ".jpg";
                break;
                case 'image/png':
                $extension = ".jpg";
                break;
                default:
                return false;
                break;
            }
        }
        if($type == 'music') {
            switch ($file['type']) {
                case 'audio/mp3':
                $extension = ".mp3";
                break;
                case 'audio/mp4':
                $extension = ".mp4";
                break;
                case 'audio/wav':
                $extension = ".wav";
                break;
                default:
                return false;
                break;
            }
        }

        $directory = "public/storage/" . $type . "/" . date('Y') . "/" . date('n') . "/";
        $filename = md5($file['name']).mt_rand().uniqid();
        $path = $directory.$filename.$extension;
        
        if (!file_exists($directory) && !is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (move_uploaded_file($file["tmp_name"], $path)) {
            return $path;
        } else {
            return false;
        }

        return false;
    }
    public static function mediaExist($id)
    {
        $qb = new QueryBuilder();
        $exist = $qb->all('media')->where('id', $id)->get();
        
        if (empty($exist)) {
            return false;
        } else {
            return true;
        }
    }

    public static function deleteMedia($media)
    {
        $qb = new QueryBuilder();
        $qb->delete()->from('media')->where('id', $media)->get();
    }


    /**
     * [editImage description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editImage($data)
    {
        $media = new Media();
        $media->setId($data['id']);
        $media->setName($data['name']);
        $media->setDescription($data['description']);
        $media->setCaption($data['caption']);
        $media->setAlttext($data['alttext']);


        $media->save();

        View::setFlash("Succès !", 'Le media "'.$data['name'].'" a bien été modifié', "success");
        Route::redirect('Medias');
        return true;
    }


    public static function editVideo($data)
    {
        $media = new Media();
        $media->setId($data['id']);
        $media->setName($data['name']);
        $media->setDescription($data['description']);
        $media->save();

        View::setFlash("Succès !", 'Le media "'.$data['name'].'" a bien été modifié', "success");
        Route::redirect('Medias');
        return true;
    }

    public static function editMusic($data)
    {
        $media = new Media();
        $media->setId($data['id']);
        $media->setName($data['name']);
        $media->setDescription($data['description']);
        $media->save();

        View::setFlash("Succès !", 'Le media "'.$data['name'].'" a bien été modifié', "success");
        Route::redirect('Medias');
        return true;
    }

    public static function imgById($id){
        $qb = new QueryBuilder();
        return $qb->select('path')->from('media')->where('id',$id)->fetchOne();
    }

  
}
