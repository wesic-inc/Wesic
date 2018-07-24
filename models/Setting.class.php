<?php

class Setting extends SettingRepository
{
  protected $id;
  protected $type;
  protected $value;

  public function updateOnKey(){
    return $this->id;
  }
  public function getPkStr(){
    return "id";
  }
  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }
  public function getValue()
  {
    return $this->value;
  }

  public function setValue($value)
  {
    $this->value = $value;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType($type)
  {
    $this->type = $type;
  }


  public static function getFormSettings()
  {
    return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Sauvegarder", "enctype"=>"multipart/form-data", "submit-custom"=>"true", "group"=>"true"],
      "struct" => [
       "title"=>["label"=> "Titre du site", "type"=>"text", "id"=>"loginco", "placeholder"=>"Titre", "required"=>1, "msgerror"=>"login" ],

       "slogan"=>["label"=> "Slogan du site", "type"=>"text", "id"=>"slogan", "placeholder"=>"Slogan", "msgerror"=>"slogan","helper"=>"En quelques mots, décrivez la raison d’être de ce site." ],

       "separator"=>["type"=>"separator"],

       "url"=>["label"=> "Adresse du site", "type"=>"text", "id"=>"url", "placeholder"=>"URL", "required"=>1, "msgerror"=>"url", "helper"=>"Attention, si vous modifiez l'url de votre site de manière incorrecte, il pourrait ne plus être accessible." ],

       "email"=>["label"=> "Adresse de messagerie", "type"=>"email", "id"=>"email", "placeholder"=>"Email", "msgerror"=>"email", "helper"=>"Cette adresse est utilisée à des fins d’administration. Si vous la modifiez, nous enverrons un message à la nouvelle adresse afin de la confirmer. La nouvelle adresse ne sera pas active tant que vous ne l’aurez pas confirmée." ],

       "signup"=>["label"=> "Tout le monde peut s'inscrire", "type"=>"select", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"signup", "choices"=>['1'=>"Activé",'2'=>"Desactivé"] ],
       
        "logout-all"=>['type'=>'link', 'class'=>"btn btn-sm btn-alt", 'label'=>"Déconnecter tous les utilisateurs"],

       "comments"=>["label"=> "Qui peut poster un commentaire", "type"=>"select", "id"=>"comments", "placeholder"=>"Commentaires", "required"=>1, "msgerror"=>"comments", "choices"=>['1'=>"Seul les utilisateurs connectés peuvent poser un commentaire",'2'=>"Tout le monde peut poster un commentaire",'3'=>"Désactiver les commentaires"] ],

       "separator2"=>["type"=>"separator"],

        "datetype"=>["label"=> "Affichage de la date", "type"=>"select", "id"=>"loginco", "placeholder"=>"Identifiant", "required"=>1, "msgerror"=>"login","choices"=>Format::getDateType()],

        "timetype"=>["label"=> "Affichage de l'heure", "type"=>"select", "id"=>"passwordco", "placeholder"=>"Mot de passe", "msgerror"=>"slogand","choices"=>Format::getTimeType() ],
        "separator2"=>["type"=>"separator"],

        "reset-block"=>['type'=>'link', 'class'=>"btn btn-sm btn-alt", 'label'=>"Remettre à zéro l'affichage du dashboard"],
        

        "submit"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

      ]
    ];
  }
  public static function getFormSettingsPost()
  {
    return [
      "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Sauvegarder", "enctype"=>"multipart/form-data", "submit-custom"=>"true"],
      "struct" => [
       "default-cat"=>["label"=> "Catégorie par défaut des articles", "type"=>"select", "id"=>"loginco", "placeholder"=>"Titre", "required"=>1, "msgerror"=>"login","choices"=>"category" ],

       "default-format"=>["label"=> "Format par défaut des articles", "type"=>"select", "id"=>"passwordco", "placeholder"=>"Slogan", "msgerror"=>"slogand","choices"=>["1"=>"Le post en entier","2"=>"L'extrait du post"] ],

       "separator"=>["type"=>"separator"],


       "title1"=>["type"=>"title","text"=>"Messagerie email"],

       "info-box"=>["type"=>"info","text"=>"Vous pouvez renseigner les informations de connexion à votre serveur mail. Cet email sera utilisé pour envoyer des newsletter, un lien pour réinitialiser son mot de passe ou encore pour confirmer un nouvel utilisateur"],

       "mail-server"=>["label"=> "Serveur de messagerie", "type"=>"text", "id"=>"url", "placeholder"=>"Serveur smtp",  "msgerror"=>"url" ],

       "mail-port"=>["label"=> "Port du serveur de messagerie", "type"=>"text", "id"=>"url", "placeholder"=>"Port smtp", "msgerror"=>"url" ],

       "mail-login"=>["label"=> "Identifiant", "type"=>"text", "id"=>"email", "placeholder"=>"Identifiant (e-mail)", "msgerror"=>"email" ],

       "mail-password"=>["label"=> "Mot de passe", "type"=>"text", "id"=>"loginco", "placeholder"=>"Mot de passe",  "msgerror"=>"login" ],

       "submit"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

     ]
   ];
 }
 public static function getFormSettingsView()
 {
  return [
    "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Sauvegarder", "enctype"=>"multipart/form-data", "submit-custom"=>"true"],
    "struct" => [
     "homepage"=>["label"=> "La page d’accueil affiche", "type"=>"select", "id"=>"homepage", "placeholder"=>"Titre", "required"=>1, "msgerror"=>"login","choices"=> Post::getParentPageList()],

     "pagination-posts"=>["label"=> "Les pages du site doivent afficher au plus", "type"=>"text", "id"=>"pagination-posts", "placeholder"=>"Slogan", "msgerror"=>"slogand" ],

     "pagination-rss"=>["label"=> "Le flux RSS du site doivent afficher au plus", "type"=>"text", "id"=>"pagination-rss", "placeholder"=>"Slogan", "msgerror"=>"slogand" ],

     "display-post"=>["label"=> "Pour chaque article d’un flux, fournir", "type"=>"select", "id"=>"display-post", "placeholder"=>"Slogan", "msgerror"=>"slogan","choices"=>['1'=>'Le texte complet','2'=>"L'extrait"] ],

     "submit"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

   ]
 ];
}

public static function getInstallForm(){
  return [
    "options" => [ "method"=>"POST", "action"=>"", "submit"=>"Sauvegarder", "enctype"=>"multipart/form-data", "submit-custom"=>"true"],
    "struct" => [

     "title"=>["label"=> "Le nom de votre site", "type"=>"text", "id"=>"pagination-posts", "placeholder"=>"Nom du site", "msgerror"=>"slogand" ],

     "email"=>["label"=> "L'adresse mail de récupération", "type"=>"email", "id"=>"pagination-rss", "placeholder"=>"E-mail", "msgerror"=>"slogand" ],

     "username"=>["label"=> "Votre nom d'utilisateur", "type"=>"text", "id"=>"pagination-posts", "placeholder"=>"Nom d'utilisateur", "msgerror"=>"slogand" ],

     "password1"=>[ "label"=>"Mot de passe", "type"=>"password", "id"=>"password1", "placeholder"=>"Mot de passe", "required"=>1, "msgerror"=>"password1" ],

     "password2"=>[ "label"=>"Confirmation mot de passe", "type"=>"password", "id"=>"password2", "placeholder"=>"Confirmation", "required"=>1, "msgerror"=>"password2", "confirm"=>"password1" ],


     "submit"=>[ "label"=>"Sauvegarder", "type"=>"submit", "id"=>"connect", "placeholder"=>"", "required"=>0]

   ]
 ];
}

}
