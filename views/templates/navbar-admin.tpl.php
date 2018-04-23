<header>
    <nav class="navbar">
      <a href="index.html">
        <img class="navbar-icon" src="../public/img/dark.svg">
      </a>
      <div class="hamburger hidden-lg" id="hamburger-menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>
      <ul class="nav" id="menu">
        <li ><a href="<?php echo ROOT_URL ?>admin" class="active">Accueil</a></li>
        <li class="dropdown-link" >
          <a href="" >Articles</a>
          <div class="dropdown">
            <ul> 
              <li><a href="<?php echo ROOT_URL ?>admin/articles">Tous les articles</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/ajouter-article">Ajouter un article</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/categories">Catégories</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/tags">Tags</a> </li> 
            </ul>
          </div>
        </li>
        <li class="dropdown-link" ><a href="">Pages</a>
          <div class="dropdown">
            <ul> 
              <li><a href="<?php echo ROOT_URL ?>admin/pages">Toutes les pages</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/ajouter-page">Ajouter une page</a> </li>  
            </ul>
          </div>
        </li>
        <li><a href="<?php echo ROOT_URL ?>admin/medias">Médias</a></li>
        <li class="dropdown-link" >
          <a href="#">Evènements</a>
          <div class="dropdown">
            <ul> 
              <li><a href="<?php echo ROOT_URL ?>admin/evenements">Tous les événements</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/ajouter-evenements">Ajouter un événement</a> </li>  
            </ul>
          </div>
        </li>
        <li><a href="<?php echo ROOT_URL ?>admin/commentaires">Commentaires</a></li>
                <li><a href="<?php echo ROOT_URL ?>admin/users">Utilisateurs</a></li>
        <li class="dropdown-link">
          <a  href="#">Apparence</a>
          <div class="dropdown">
            <ul> 
              <li><a href="<?php echo ROOT_URL ?>admin/modifier-theme">Modifier le thème</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/themes">Mes thèmes</a> </li>  
              <li><a href="<?php echo ROOT_URL ?>admin/theme-creator">Theme Creator</a> </li>  
            </ul>
          </div></li>
          <li ><a href="<?php echo ROOT_URL ?>admin/parametres">Paramètres</a></li>
          <div class="user-menu ">
            <a href="#">
              <span> Elon Musk </span>
              <img class="avatar" src="../public/img/user.jpg">
              <img class="cicon-carret " src="../public/img/carret.svg">
            </a>
          </div>
        </ul>
      </nav>  
    </header>