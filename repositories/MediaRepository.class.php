<?php

class MediaRepository extends Basesql{
	
	static function mediaExist($id){
		$qb = new QueryBuilder();
		$exist = $qb->all('media')->where('id',$id)->get();
		
		if(empty($exist)){
			return false;
		}else{
			return true;
		}
	}
}