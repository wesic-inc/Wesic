<?php require('views/templates/navbar-admin.tpl.php'); ?>
<?php $this->createForm($form, $errors); ?>
	<h1 class="page-title"><span class="icon-newspaper">

		</span>	 Ajouter un article </h1> 
		<div class="container">
			<div class="row">
				<div class="col-md-12 bloc ignore-me article-bloc">
					<div class="row row-forms">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-12 form-group">
									<p class="form-group-title">Titre</p>
									<p class="subtitle">Le titre de votre article</p>
									<input type="text" class="full">
								</div>
								<div class="col-md-12 form-group">
									<p class="form-group-title mb-20">Contenu de l’article</p>
									<a href="#" class="btn btn-sm add-media"> Ajouter un média </a>
									<div id="wesic-demo"></div>
								</div>
								<div class="col-md-12 form-group">
									<p class="form-group-title">Résumé de l'article</p>
									<textarea></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-offset-1 col-md-4 col-tools-add">
							<div class="row">
								<div class="col-md-12 form-group">
									<p class="form-group-title form-group-aside">Publier</p>
									<ul class="publication-choices">
										<li class="m-20">
											<div class="row">
												<div class="col-md-4">
													<span>URL Slug</span>
												</div>
												<div class="col-md-8">
													<input type="text" class="full">
												</div>
											</li>
											<li class="m-20">
												<div class="row">	
													<div class="col-md-4">
														<span>Statut</span>
													</div>
													<div class="col-md-8">
														<select class="full">
															<option>Brouillon</option>
															<option>Brouillon</option>
															<option>Brouillon</option>
														</select>
													</div>
												</div>
											</li>
											<li class="m-20">
												<div class="row">	
													<div class="col-md-4">
														<span>Visibilité</span>
													</div>
													<div class="col-md-8">
														<select class="full">
															<option>Brouillon</option>
															<option>Brouillon</option>
															<option>Brouillon</option>
														</select>
													</div>
												</li>
											</ul>
											<div class="form-btn text-center">
												<a href="#" class="btn btn-sm btn-alt"> Brouillon </a>
												<a href="#" class="btn btn-sm"> Publier </a>
											</div>
										</div>
										<div class="col-md-12 form-group">
											<p class="form-group-title form-group-aside">Catégories</p>
											<div class="checkbox-group">
												<ul>
													<li><input type="radio" id="ex1"><label for="ex1"></label><span>Concert</span></li>
													<li><input type="radio" id="ex2"><label for="ex2"></label><span>Musique</span></li>
													<li><input type="radio" id="ex3"><label for="ex3"></label><span>Tournée</span></li>
													<li><input type="radio" id="ex4"><label for="ex4"></label><span>Lorem</span>	</li>
												</ul>
											</div>
										</div>
										<div class="col-md-12 form-group">
											<p class="form-group-title form-group-aside">Tags</p>
											<div class="checkbox-group">
												<ul>
													<li><input type="checkbox" name="" id="test1"><label for="test1"></label><span>Concert</span></li>
													<li><input type="checkbox" name="" id="test2"><label for="test2"></label><span>Musique</span></li>
													<li><input type="checkbox" name="" id="test3"><label for="test3"></label><span>Tournée</span></li>
													<li><input type="checkbox" name="" id="test4"><label for="test4"></label><span>Lorem</span>	</li>
												</ul>
											</div>
										</div>
										<div class="col-md-12 form-group text-center">
											<p class="form-group-title form-group-aside">Image mise en avant</p>
											<a href="#" class="btn btn-sm "> Ajouter une image </a>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>