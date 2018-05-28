<?php 
class Stat extends Basesql{
	protected $id;
	protected $type;
	protected $date;
	protected $body;
	protected $ip;
	protected $useragent;
	protected $referer;
	protected $content_type;
	protected $content_id;

	public function __construct(){
		parent::__construct();
	}

    /**
     * @return mixed
     */
    public function getId()
    {
    	return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
    	$this->id = $id;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
    	return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
    	$this->type = $type;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
    	return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate($date="")
    {
        if(empty($date)){

           $this->date = date("Y-m-d H:i:s");
       }else{
        $this->date = $date;

    }
    return $this;
}

    /**
     * @return mixed
     */
    public function getIp()
    {
    	return $this->ip;
    }

    /**
     * @param mixed $ip
     *
     * @return self
     */
    public function setIp($ip)
    {
        if(empty($ip)){
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $this->ip = $ip;
        }

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getUseragent()
    {
    	return $this->useragent;
    }

    /**
     * @param mixed $useragent
     *
     * @return self
     */
    public function setUseragent()
    {
        if(isset($_SERVER['HTTP_USER_AGENT']))
           $this->useragent = $this->pdo->quote($_SERVER['HTTP_USER_AGENT']);

       return $this;
   }

    /**
     * @return mixed
     */
    public function getReferer()
    {
    	return $this->referer;
    }

    /**
     * @param mixed $referer
     *
     * @return self
     */
    public function setReferer()
    {
        if(isset($_SERVER['HTTP_REFERER']))
            $this->referer = $this->pdo->quote($_SERVER['HTTP_REFERER']);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
    	return $this->content_type;
    }

    /**
     * @param mixed $content_type
     *
     * @return self
     */
    public function setContentType($content_type)
    {
    	$this->content_type = $content_type;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getContentId()
    {
    	return $this->content_id;
    }

    /**
     * @param mixed $content_id
     *
     * @return self
     */
    public function setContentId($content_id)
    {
    	$this->content_id = $content_id;

    	return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
    	return $this->body;
    }

    /**
     * @param mixed $body
     *
     * @return self
     */
    public function setBody($body)
    {
    	$this->body = $body;

    	return $this;
    }


    public static function add($type,$body="",$contentType=0,$contentId=0){

    	$stat = new Stat();

    	$stat->setType($type);
    	$stat->setBody($body);
      $stat->setDate();
      $stat->setContentType($contentType);
      $stat->setContentId($contentId);


      $stat->setIp();
      $stat->setUseragent();
      $stat->setReferer();
      $stat->save();

  }

public static function numberOfViewsAnon(){

    $lastYear = date('Y-m-d',strtotime("-365 days", time()));
    $lastSemester = date('Y-m-d',strtotime("-6 months", time()));
    $lastTrimester = date('Y-m-d',strtotime("-3 months", time()));
    $lastWeek = date('Y-m-d',strtotime("-1 week", time()));
    $today = date('Y-m-d',strtotime("-1 day", time()));
   
    $qb = new QueryBuilder();
   
    $results['year'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastYear)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();
    

    $qb->reset();

    $results['semester'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastSemester)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['trimester'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastTrimester)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['week'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastWeek)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('DAY(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['today'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$today)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',1)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('HOUR(date)')
    ->orderBy('date','ASC')
    ->execute();

    return $results;
}

public static function numberOfViewsKnown(){

    $lastYear = date('Y-m-d',strtotime("-365 days", time()));
    $lastSemester = date('Y-m-d',strtotime("-6 months", time()));
    $lastTrimester = date('Y-m-d',strtotime("-3 months", time()));
    $lastWeek = date('Y-m-d',strtotime("-1 week", time()));
    $today = date('Y-m-d',strtotime("-1 day", time()));
   
    $qb = new QueryBuilder();
   
    $results['year'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastYear)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',2)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();
    

    $qb->reset();

    $results['semester'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastSemester)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',2)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['trimester'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastTrimester)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',2)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('YEAR(date), MONTH(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['week'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$lastWeek)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',2)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('DAY(date)')
    ->orderBy('date','ASC')
    ->execute();

    $qb->reset();

    $results['today'] = $qb->select('COUNT(id)')
    ->from('stat')
    ->addWhere('date > :dateStart')
    ->setParameter('dateStart',$today)
    ->and()
    ->addWhere('type = :type')
    ->setParameter('type',2)
    ->and()
    ->addWhere('date < :dateEnd')
    ->setParameter('dateEnd',date('Y-m-d'))
    ->groupBy('HOUR(date)')
    ->orderBy('date','ASC')
    ->execute();

    return $results;
}

public static function recreateScale(){

    $scale = [];

    for($i=0;$i<12;$i++){
        $scale['year'][$i] = date('M', strtotime('-'.$i.' month'));

    }

    for($i=0;$i<6;$i++){
        $scale['semester'][$i] = date('M', strtotime('-'.$i.' month'));
    }

    for($i=0;$i<3;$i++){
        $scale['trimester'][$i] = date('M', strtotime('-'.$i.' month'));
    }

    for($i=0;$i<7;$i++){
        $scale['week'][$i] = date('D', strtotime('-'.$i.' days'));
    }

    for($i=0;$i<24;$i++){
        $scale['today'][$i] = date('H', strtotime('-'.$i.' hours')).':00';
    }

    // dump($scale,2,2);

    return $scale;

}

public static function mostViewedPages(){

}

public static function mostDownloadedMusic(){

}

public static function mostDownloadedAlbum(){

}

public static function unknowVisitors(){

}

public static function knowVisitors(){

}

public static function fakeStats($number){

$stat = new Stat();


for($i=0;$i<$number;$i++){

     $stat->setType(rand(1,2));
     $stat->setBody("testPurpoe");

     $int= rand(1495317983,1526853983);

      $stat->setDate(date("Y-m-d H:i:s",$int));
      $stat->setContentType(rand(1,7));
      $stat->setContentId(rand(1,50));

      $stat->setIp(long2ip(rand(0, "4294967295")));
      $stat->setUseragent();
      $stat->setReferer();
      $stat->save();
}
}

}