<?php if($_COOKIE["toggled-sidebar"] == 'true'): ?>
<div class="navbar-sidebar collapsed" id="navbar">
<?php else: ?>
<div class="navbar-sidebar toggled" id="navbar"> 
<?php endif; ?>

	<div class="siteinfo">

		<a href="<?php echo Setting::getParam('url'); ?>">
			<img class="navbar-icon" src="<?php echo ROOT_URL.Setting::getParam('favicon'); ?>">
			<span class="link-text"><?php echo Setting::getParam('title'); ?></span>
		</a>
	</div>

	<ul class="nav" id="menu">
		<li class="<?php echo ($c == "admin" && $a == "index" )?"active":"";?>"><a href="<?php echo Route::echo('Admin'); ?>"><span class="icon icon-stats-bars"></span><span class="link-text">Dashboard</span></a></li>
		<li class="dropdown-link <?php echo ($c == "article" && $a == "allArticles" )?"active":"";?>">
			</span><a href="#""><span class="icon icon-newspaper"></span><span class="link-text">Articles <span class="icon-ctrl carret-down" id="dropdown-toggle"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php Route::echo('AllArticles'); ?>"> Tous les articles</a> </li> 
					<li><a href="<?php Route::echo('NewArticle'); ?>">Ajouter un article</a> </li> 
					<li><a href="<?php Route::echo('Categories'); ?>">Catégories</a> </li> 
					<li><a href="<?php Route::echo('Tags'); ?>">Tags</a> </li> 
					<li><a href="<?php Route::echo('Newsletter'); ?>">Newsletter</a> </li>
				</ul>
			</div>
		</li>
		<li class="dropdown-link <?php echo ($c == "page" && $a == "index" )?"active":"";?>" ><a href="#"><span class="icon icon-files-empty"></span><span class="link-text">Pages<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php Route::echo('Pages'); ?>">Toutes les pages</a> </li> 
					<li><a href="<?php Route::echo('NewPage'); ?>">Ajouter une page</a> </li>  
				</ul>
			</div>
		</li>
		<li classs="<?php echo ($c == "media" && $a == "index" )?"active":"";?>">
			<a href="<?php Route::echo('Medias'); ?>">
				<span class="icon icon-images"></span>
				<span class="link-text">Médias</span></a></li>
		<li class="dropdown-link" >
			<a href="#"><span class="icon icon-alarm"></span><span class="link-text">Evènements<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php Route::echo('Events'); ?>">Tous les événements</a> </li> 
					<li><a href="<?php Route::echo('AddEvent'); ?>">Ajouter un événement</a> </li>  
				</ul>
			</div>
		</li>
		<li class="<?php echo ($c == "comment" && $a == "index" )?"active":"";?>">
			<a href="<?php Route::echo('Comments'); ?>"><span class="icon icon-bubbles2"></span><span class="link-text">Commentaires</span></a>
		</li>
		<li class="<?php echo ($c == "user" )?"active":"";?>">
			<a href="<?php Route::echo('AllUsers'); ?>">
				<span class="icon icon-users"></span><span class="link-text">Utilisateurs</span></a>
			</li>
		<li class="dropdown-link <?php echo ($c == "theme" && $a == "index" )?"active":"";?>"> 
			<a href="#"><span class="icon icon-paint-format"></span><span class="link-text">Apparence<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php Route::echo('EditTheme'); ?>">Modifier le thème</a> </li> 
					<li><a href="<?php Route::echo('Themes'); ?>">Mes thèmes</a> </li>  
					<li><a href="<?php Route::echo('ThemeCreator'); ?>">Menu</a> </li>  
					<li><a href="<?php Route::echo('ThemeCreator'); ?>">Theme Creator</a> </li> 

				</ul>
			</div></li>
		<li class="dropdown-link <?php echo ($c == "setting" )?"active":""; ?>"> 
			<a href="#"><span class="icon icon-equalizer"></span><span class="link-text">Paramètres<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php Route::echo('generalSettings'); ?>">Général</a> </li> 
					<li><a href="<?php Route::echo('postSettings'); ?>">Ecriture</a> </li>  
					<li><a href="<?php Route::echo('viewSettings'); ?>">Lecture</a> </li>  
				</ul>
			</div></li>
			<li class="<?php echo ($c == "stat" && $a == "index" )?"active":"";?>">
			<a href="<?php Route::echo('Stats'); ?>">
				<span class="icon icon-stats-dots"></span><span class="link-text">Statistiques</span></a>
			</li>
			<li class="<?php echo ($c == "admin" && $a == "devTest" )?"active":"";?>">
			<a href="<?php Route::echo('DevTest'); ?>">
				<span class="icon icon-embed2"></span><span class="link-text">Dev test</span></a>
			</li>
    </ul>
</div>

<?php if($_COOKIE["toggled-sidebar"] == 'true'): ?>
<div class="second-navbar" id="second-navbar">
<div class="hamburger menu-sidebar" id="hamburger-menu">
<?php else: ?>
<div class="second-navbar collapsed" id="second-navbar"> 
<div class="hamburger menu-sidebar is-active" id="hamburger-menu">
<?php endif; ?>


	<span class="line"></span>
	<span class="line"></span>
	<span class="line"></span>
</div>

<div class="breadcrumb" id="breadcrumb">
	<span class="icon <?php echo $icon;?>"></span> <?php echo $title; ?> 
</div>

</div>
          <div class="user-menu">

              <span> <?php echo Singleton::getUser()->getLogin(); ?> </span>
              <img class="avatar" src="<?php Format::img('user.jpg'); ?>">
            </a>
          <div class="dropdown">
            <ul> 
              <li><a href="<?php Route::echo('Profile'); ?>">Mon profil</a> </li> 
              <li><a href="<?php Route::echo('Logout'); ?>">Se déconneter</a> </li> 
            </ul>
          </div>
        </div>