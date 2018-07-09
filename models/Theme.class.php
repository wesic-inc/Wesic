<?php

class Theme extends ThemeRepository
{
    protected $id;
    protected $title;
    protected $version;
    protected $author;

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


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower(trim($title)));
    }


    public function getVersion()
    {
        return $this->version;
    }


    public function setVersion($version)
    {
        $this->version = $version;
    }


    public function getAuthor()
    {
        return $this->author;
    }


    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getBlock($id){

        $welcome = '                <div class="col-md-12 bloc welcome-bloc draggable handle" id="welcome-bloc">
                    <div class="inner-bloc">
                        <span class="icon-cross bloc-close" onclick="dismissWelcome()"></span>
                        <header>
                            <h2 class="bloc-title"> Bienvenue sur Wesic ! </h2>
                            <span class="bloc-subtitle"> Nous vous avons préparé de quoi partir du bon pied </span>
                        </header>
                        <article class="welcome-article">
                            <div class="row">
                                <div class="col-md-6">
                                    <p> Nous sommes là pour vous aidez à promouvoir votre musique ! Wesic n’est pas un CMS classique. Il a été conçu par des musiciens pour des musiciens. Il répond aux besoins actuels d’un groupe ou d’un artiste en terme de site web. Amusez vous bien ! <i> - L’équipe de Wesic Inc.</i></p> 
                                </div>
                                <div class="col-md-6 text-center welcome-start">
                                    <a href="#" class="btn btn-lg welcome-btn"> Démarage rapide </a>
                                    <p class="subtext"> Vous découvrez notre outil pour la première fois ? Suivez le guide ! </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>';
        $stats = '                  <div class="col-lg-12 bloc draggable gutter-bloc stats" id="stats">
                        <div class="inner-bloc">

                            <span class="icon-menu bloc-close handle"> </span>
                            <header>
                                <h2 class="bloc-title"><span class="icon-stats-dots"></span> Statistiques</h2>
                            </header>
                            <article>
                                <ul class="numbers">
                                    <li><span>4400</span><p> utilisateurs unique les 30 derniers jours</p></li>
                                    <li><span>15</span><p> nouveaux commentaires aujourd’hui</p></li>
                                    <li><span>+50%</span><p> de traffic sur les 30 derniers jours</p></li>
                                </ul>
                                <canvas id="myChart" height="200"></canvas>

                                <ul class="btns">
                                    <li><a href="#" class="btn btn-sm btn-alt-inverted"> 1 an </a></li>
                                    <li><a href="#" class="btn btn-sm btn-alt-inverted"> 6 mois </a></li>
                                    <li><a href="#" class="btn btn-sm btn-alt-inverted"> 3 mois </a></li>
                                    <li><a href="#" class="btn btn-sm btn-alt-inverted"> 30 jours </a></li>
                                    <li><a href="#" class="btn btn-sm btn-alt-inverted"> Aujourd\'hui </a></li>
                                </ul>
                            </article>
                        </div>
                    </div>';
        $quickview = '                  <div class="col-lg-12 bloc draggable quick-view" id="quickview">
                        <div class="inner-bloc">

                            <span class="icon-menu bloc-close handle">
                            </span>
                            <header>
                                <h2 class="bloc-title"><span class="icon-eye"></span> Coup d’oeil</h2>
                            </header>
                            <article>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul>
                                            <li><span class="icon-newspaper stat-number"></span> <?php echo $articles; ?> articles</li>
                                            <li><span class="icon-file-empty stat-number"></span> <?php echo $pages; ?>  pages</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul>
                                            <li><span class="icon-bubbles stat-number"></span> <?php echo $comments; ?> commentaires</li>
                                            <li><span class="icon-sphere stat-number"></span> <?php echo $events; ?> événements</li>
                                        </ul>
                                    </div>
                                </div>
                                <p> Wesic est en version <?php echo WESIC_VERSION; ?> avec le thème <span> Minimalism </span> </p>
                                <a class="btn btn-sm btn-danger update-wesic"> Mettre à jour </a>
                            </article>
                        </div>
                    </div>';
        $activity = 'lol'

        $blocs = [
            'comments'=>$comment,
            'quickview'=>$quickview,
            'activity'=>$activity,
            'stats'=>$stats,
            'welcome-bloc'=>$welcome,
            'links-bloc'=>$links
        ];

        return $comment;
    }
}
