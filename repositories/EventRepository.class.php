<?php

class EventRepository extends Basesql
{
    public static function addEvent($data)
    {

        $publishedAt = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $event = new Event();
        $event->setName($data['name']);
        $event->setPlace($data['place']);
        $event->setExternalurl($data['externalurl']);
        $event->setDescription($data['description']);
        $event->setDate($publishedAt);
        $event->setFeatured($data['featured']);
        $event->setUserId(Auth::id());
        $event->save();

        View::setFlash("Succès !", "L'événement <i>".ucfirst($data['name'])."</i> a bien été ajouté", "success");

        return true;
    }

    /**
     * [editEvent description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editEvent($data)
    {
        $qb = new QueryBuilder();

        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $event = new Event();
        $event->setId($data['id']);
        $event->setName($data['name']);
        $event->setPlace($data['place']);
        $event->setExternalurl($data['externalurl']);
        $event->setDescription($data['description']);
        $event->setDate($datePublied);
        (isset($data['image'])) ? $event->setImage($data['image']) : $event->setImage("");
        $event->setUserId(Singleton::getUser()->getId());
        $event->save();

        View::setFlash("Succès !", "L'événement <i>".ucfirst($data['name'])."</i> a bien été modifié", "success");

        return true;
    }

    /**
     * [deleteEvent description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function deleteEvent($id)
    {
        $qb = new QueryBuilder();

        $toDelete = $qb->delete()
        ->from('event')
        ->Where('id', '=', $id);
        $toDelete->execute();

        View::setFlash("Succès !", "L'événement a bien été supprimé", "success");
    }
}
