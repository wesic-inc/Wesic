<?php

class SettingRepository extends Basesql
{

    /**
     * [editSettings description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editSettings($data)
    {


        $setting = new Setting();
        $setting
        ->setParam('title', $data['title'])
        ->setParam('url', $data['url'])
        ->setParam('slogan', $data['slogan'])
        ->setParam('email', $data['email'])
        ->setParam('signup', $data['signup'])
        ->setParam('comments', $data['comments'])
        ->setParam('datetype', $data['datetype']);
        View::setFlash('Génial !', 'Les paramètres ont bien été enregistrés !', 'success');

        return true;
    }

    /**
     * [editSettingsPost description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editSettingsPost($data)
    {
        $setting = new Setting();
        $setting
        ->setParam('mail-server', $data['mail-server'])
        ->setParam('mail-port', $data['mail-port'])
        ->setParam('mail-login', $data['mail-login'])
        ->setParam('mail-password', $data['mail-password'])
        ->setParam('default-cat', $data['default-cat'])
        ->setParam('default-format', $data['default-format']);

        View::setFlash('Génial !', 'Les paramètres ont bien été enregistrés !', 'success');

        return true;
    }

    /**
     * [editSettingsView description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editSettingsView($data)
    {
        $setting = new Setting();
        $setting
        ->setParam('homepage', $data['homepage'])
        ->setParam('pagination-posts', $data['pagination-posts'])
        ->setParam('pagination-rss', $data['pagination-rss'])
        ->setParam('display-post', $data['display-post']);

        View::setFlash('Génial !', 'Les paramètres ont bien été enregistrés !', 'success');

        return true;
    }

    /**
     * [getSettings description]
     * @return [type] [description]
     */
    public static function getSettings()
    {
        $qb = new QueryBuilder();

        $params = $qb->all('setting')->get();

        $output = [];

        foreach ($params as $value) {
            $output[$value['id']] = $value;
        }

        return $output;
    }

    /**
     * [getParam description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getParam($id)
    {
        $qb = new QueryBuilder();
        $param = $qb->select('value')->from('setting')->where('id', $id)->fetchOne();

        return $param['value'];
    }

    /**
     * [setParam description]
     * @param [type] $id    [description]
     * @param [type] $value [description]
     */
    public function setParam($id, $value)
    {

        if (empty($value) || !isset($value)) {
            $this->value = null;
        } else {
            $this->value = $value;
        }
        $this->id = $id;
        $this->save();
        
        return $this;
    }
}
