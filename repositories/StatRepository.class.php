<?php 
class StatRepository extends Basesql
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [add description]
     * @param [type]  $type        [description]
     * @param string  $body        [description]
     * @param integer $contentType [description]
     * @param integer $contentId   [description]
     */
    public static function add($type, $body="", $contentType=0, $contentId=0)
    {
        $stat = new Stat();

        $stat->setType($type);
        $stat->setBody($body);
        $stat->setDate();
        $stat->setContentType($contentType);
        $stat->setContentId($contentId);
        $stat->setIp();
        $stat->setUrl();
        $stat->setUseragent();
        $stat->setReferer();
        $stat->save();
    }

    public static function uniqLastMonth()
    {
        $lastMonth = date('Y-m-d', strtotime("-1 months", time()));
        
        $qb = new QueryBuilder();

        $qb->reset();

        $results = $qb->
        select('DISTINCT(ip)')
        ->from('stat')
        ->where('date', '>', $lastMonth)
        ->and()
        ->where('type', 1)
        ->and()
        ->where('date', '<', date('Y-m-d H:i:s'))
        ->groupBy('ip')
        ->orderBy('date', 'ASC')
        ->get();

        return count($results);
    }

    public static function uniqOverall()
    {
        $qb = new QueryBuilder();

        $qb->reset();

        $results = $qb->
        select('DISTINCT(ip)')
        ->from('stat')
        ->where('type', 1)
        ->and()
        ->where('date', '<', date('Y-m-d H:i:s'))
        ->groupBy('ip')
        ->orderBy('date', 'ASC')
        ->get();

        return count($results);
    }

    public static function dashboardChart()
    {
        $lastMonth = date('Y-m-d', strtotime("-6 months", time()));
        
        $qb = new QueryBuilder();

        $qb->reset();

        $results = $qb->
        select('COUNT(ip)')
        ->from('stat')
        ->where('date', '>', $lastMonth)
        ->and()
        ->where('type', 1)
        ->and()
        ->where('date', '<', date('Y-m-d H:i:s'))
        ->groupBy('MONTH(date)')
        ->orderBy('date', 'ASC')
        ->get();

        $stats = [];

        foreach ($results as $value) {
            $stats[] = $value[0];
        }

        return $stats;
    }

    public static function commentToday()
    {
        $today = date('Y-m-d', strtotime("-24 hours", time()));
        
        $qb = new QueryBuilder();

        $qb->reset();

        $results = $qb->
        select('COUNT(*)')
        ->from('comment')
        ->where('date', '>', $today)
        ->and()
        ->where('type', 1)
        ->and()
        ->addWhere('date', '<', date('Y-m-d H:i:s'))
        ->groupBy('ip')
        ->orderBy('date', 'ASC')
        ->get();

        return count($results);
    }



    /**
     * [numberOfViewsAnon description]
     * @return [type] [description]
     */
    public static function numberOfViewsAnon()
    {
        $lastYear = date('Y-m-d', strtotime("-365 days", time()));
        $lastSemester = date('Y-m-d', strtotime("-6 months", time()));
        $lastTrimester = date('Y-m-d', strtotime("-3 months", time()));
        $lastWeek = date('Y-m-d', strtotime("-1 week", time()));
        $today = date('Y-m-d', strtotime("-1 day", time()));
   
        $qb = new QueryBuilder();
   
        $results['year'] =
        $qb->select('COUNT(id)')
        ->from('stat')
        ->where('date', '>', $lastYear)
        ->and()
        ->where('type', 1)
        ->and()
        ->where('date', '<', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();
    

        $qb->reset();

        $results['semester'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastSemester)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 1)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['trimester'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastTrimester)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 1)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['week'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastWeek)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 1)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('DAY(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['today'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $today)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 1)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('HOUR(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        return $results;
    }

    /**
     * [numberOfViewsKnown description]
     * @return [type] [description]
     */
    public static function numberOfViewsKnown()
    {
        $lastYear = date('Y-m-d', strtotime("-365 days", time()));
        $lastSemester = date('Y-m-d', strtotime("-6 months", time()));
        $lastTrimester = date('Y-m-d', strtotime("-3 months", time()));
        $lastWeek = date('Y-m-d', strtotime("-1 week", time()));
        $today = date('Y-m-d', strtotime("-1 day", time()));
   
        $qb = new QueryBuilder();
   
        $results['year'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastYear)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();
    

        $qb->reset();

        $results['semester'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastSemester)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['trimester'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastTrimester)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('YEAR(date), MONTH(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['week'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $lastWeek)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('DAY(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        $qb->reset();

        $results['today'] = $qb->select('COUNT(id)')
        ->from('stat')
        ->addWhere('date > :dateStart')
        ->setParameter('dateStart', $today)
        ->and()
        ->addWhere('type = :type')
        ->setParameter('type', 2)
        ->and()
        ->addWhere('date < :dateEnd')
        ->setParameter('dateEnd', date('Y-m-d'))
        ->groupBy('HOUR(date)')
        ->orderBy('date', 'ASC')
        ->execute();

        return $results;
    }

    /**
     * [recreateScale description]
     * @return [type] [description]
     */
    public static function recreateScale()
    {
        $scale = [];

        for ($i=0;$i<12;$i++) {
            $scale['year'][$i] = date('M', strtotime('-'.$i.' month'));
        }

        for ($i=0;$i<6;$i++) {
            $scale['semester'][$i] = date('M', strtotime('-'.$i.' month'));
        }

        for ($i=0;$i<3;$i++) {
            $scale['trimester'][$i] = date('M', strtotime('-'.$i.' month'));
        }

        for ($i=0;$i<7;$i++) {
            $scale['week'][$i] = date('D', strtotime('-'.$i.' days'));
        }

        for ($i=0;$i<24;$i++) {
            $scale['today'][$i] = date('H', strtotime('-'.$i.' hours')).':00';
        }

        return $scale;
    }

    public static function recreateScaleDashboard()
    {
        $scale = [];

        for ($i=0;$i<6;$i++) {
            $scale[$i] = date('M', strtotime('-'.$i.' month'));
        }

        return $scale;

    }
}
