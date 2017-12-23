<body class="body-404">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template ">
                <h1>
                    Oups!</h1>
                <h2>
                    404, Page non trouvée</h2>
                <div class="error-details">
                    Désolé, une erreur s'est produite, la page demandée n'a pas été trouvé !
                </div>
                <div class="error-actions">
                <?php if(isset($_SERVER['HTTP_REFERER'])) : ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Page précédente</a>
                <?php endif; ?>
                <a href="index" class="btn btn-primary "><i class="fa fa-home" aria-hidden="true"></i> Accueil </a>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
</body>