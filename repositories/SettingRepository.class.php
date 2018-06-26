<?php

class SettingRepository extends Basesql
{
    public static function editSettings($data)
    {
        $setting = new Setting();
        $setting
  ->setParam('title', $data['title'])
  ->setParam('slogan', $data['slogan'])
  ->setParam('url', $data['url'])
  ->setParam('email', $data['email'])
  ->setParam('comments', $data['comments'])
  ->setParam('timezone', $data['timezone'])
  ->setParam('datetype', $data['datetype'])
  ->setParam('timetype', $data['timetype']);

        View::setFlash('Génial !', 'Les paramètres ont bien été enregistrés !', 'success');

        return true;
    }

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

    public static function getParam($id)
    {
        $qb = new QueryBuilder();
        $param = $qb->select('value')->from('setting')->where('id',$id)->fetchOne();

        return $param['value'];
    }

    public function setParam($id, $value)
    {
        if (empty($value)) {
            $this->value == null;
        } else {
            $this->value = $value;
        }
        $this->id = $id;
        $this->save();

  
        return $this;
    }
}
