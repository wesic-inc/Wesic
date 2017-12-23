<body class="body-404">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template ">
                <h1>
                    Oups!</h1>
                <h2>
                    403, Vous n'avez pas le droit d'accéder à cette page</h2>

                <div class="error-actions">
                <?php if(isset($_SERVER['HTTP_REFERER'])) : ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Page précédente</a>
                <?php endif; ?>
                <a href="/" class="btn btn-primary "><i class="fa fa-home" aria-hidden="true"></i> Accueil </a>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
</body>