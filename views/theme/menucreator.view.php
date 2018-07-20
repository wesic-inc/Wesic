<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 bloc">
            <div class="inner-bloc">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Pages</p>
                                <div class="scroll-y">
                                    <ul>
                                        <?php foreach($pages as $page): ?>
                                            <li onclick="insertPageToMenu(<?php echo $page['id'].',\''.$page['title'].'\'' ?>)"><?php echo $page['title'] ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php if(empty($pages)): ?>
                                        Aucune page
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>Lien personnalisé</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="input-sm" placeholder="Label de l'élement" id="menu-custom-label" type="text">
                                        <input class="input-sm" placeholder="Url" id="menu-custom-link" type="text">
                                    </div>
                                    <div class="col-md-12">
                                        <a onclick="addCustomUrlToMenu()" class="btn btn-block btn-sm btn-primary">Ajouter le lien au menu</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>Page d'accueil</p>
                                <a onclick="homeUrlToMenu()" class="btn btn-sm btn-block btn-primary">Ajouter la page d'accueil au menu</a>
                            </div>
                            <div class="col-md-12">
                                <p>Catégorie</p>
                                <div class="scroll-y">
                                    <ul>
                                        <?php foreach($categories as $cat): ?>
                                            <li onclick="insertCatToMenu(<?php echo $cat['id'].',\''.$cat['label'].'\'' ?>)"><?php echo $cat['label'] ?></li>
                                        <?php endforeach ?>
                                        <?php if(empty($categories)): ?>
                                            Aucune catégorie
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-navbar menu-creator col-md-8">
                        <a class="btn btn-sm btn-block btn-primary" onclick="saveMenu()">Sauvegarder le menu</a>
                        <br>
                        <br>
                        <div class="nested" id="top-menu">
                            <div class="item">
                                Accueil 
                                <span class="icon-cross delete-menu-item" onclick="deleteItemMenu(this)"></span>
                                <div class="nested">
                                    <div class="item">
                                        Vidéos <span class="icon-cross delete-menu-item" onclick="deleteItemMenu(this)"></span>
                                        <div class="nested"></div>
                                    </div>
                                    <div class="item">
                                        Musiques 
                                        <span class="icon-cross delete-menu-item" onclick="deleteItemMenu(this)"></span>
                                        <div class="nested"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                Settings <span class="icon-cross delete-menu-item" onclick="deleteItemMenu(this)"></span>
                                <div class="nested"></div>
                            </div>
                            <div class="item">
                                A propos <span class="icon-cross delete-menu-item" onclick="deleteItemMenu(this)"></span>
                                <div class="nested"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

