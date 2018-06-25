<?php 
class StatRepository extends Basesql
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function add($type, $body="", $contentType=0, $contentId=0)
    {
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

    public static function numberOfViewsAnon()
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
        ->setParameter('type', 1)
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

        // dump($scale,2,2);

        return $scale;
    }

    public static function mostViewedPages()
    {
    }

    public static function mostDownloadedMusic()
    {
    }

    public static function mostDownloadedAlbum()
    {
    }

    public static function unknowVisitors()
    {
    }

    public static function knowVisitors()
    {
    }

    public static function fakeStats($number)
    {
        $stat = new Stat();


        for ($i=0;$i<$number;$i++) {
            $stat->setType(rand(1, 2));
            $stat->setBody("testPurpoe");

            $int= rand(1495317983, 1526853983);

            $stat->setDate(date("Y-m-d H:i:s", $int));
            $stat->setContentType(rand(1, 7));
            $stat->setContentId(rand(1, 50));

            $stat->setIp(long2ip(rand(0, "4294967295")));
            $stat->setUseragent();
            $stat->setReferer();
            $stat->save();
        }
    }
}
