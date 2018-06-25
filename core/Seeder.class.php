<?php

class Seeder{
	public static function FakeNews($nb = 50){
		
		$article = new Post();


		for($i=0;$i<$nb;$i++){

			$slugStr = Faker::slug();

			$slug = new Slug();
			$slug->setSlug($slugStr);
			$slug->setType(1);
			$slug->save();

			$article->setType(1);  
			$article->setTitle(Faker::title(rand(2,6)));
			$article->setSlug($slugStr);
			$article->setContent(Faker::html());
			$article->setExcerpt(Faker::title(rand(10,20)));
			$article->setDescription(Faker::title(rand(10,20)));
			$article->setDatePublied(date('Y-m-d H:i:s'));
			$article->setDateCreation();
			$article->setStatus(rand(1,2));
			$article->setVisibility(1);
			$article->setUserId(1);
			$article->save();
			
			Category::createCategoryJoin(1,$article->getId());

		}


	}	

	public static function pages($nb = 50){

	}
}