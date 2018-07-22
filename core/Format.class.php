<?php

class Format
{
    /**
     * [getRole description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function getRole($code)
    {
        switch ($code) {
            case 1:
            return 'Utilisateur';
            break;
            case 2:
            return 'Community Manager';
            break;
            case 3:
            return 'Modérateur';
            break;
            case 4:
            return 'Administrateur';
            break;
            case 5:
            return 'Abonné';
            break;
            default:
            return false;
            break;
        }
    }
    /**
     * [getStatusUser description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function getStatusUser($code)
    {
        switch ($code) {
            case 1:
            return 'Actif';
            break;
            case 2:
            return 'En attente de confirmation e-mail';
            break;
            case 3:
            return 'Inactif';
            break;
            case 4:
            return 'Banni';
            break;
            case 5:
            return 'Supprimé';
            break;
            default:
            return false;
            break;
        }
    }

    /**
     * [getStatusUser description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function getStatusComment($code)
    {
        switch ($code) {
            case 1:
            return 'Approuvé';
            break;
            case 2:
            return 'En attente';
            break;
            case 3:
            return 'Désapprouvé';
            break;
            case 4:
            return 'Signalé';
            break;
            case 5:
            return 'Supprimé';
            break;
            default:
            return false;
            break;
        }
    }

    /**
     * [translateCategory description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function translateCategory($code)
    {
        $qb = new QueryBuilder();
        return $qb->all('category')->where('id', $code)->fetchOne()['label'];
    }
    /**
     * [getStatusArticle description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function getStatusArticle($code)
    {
        switch ($code) {
            case 1:
            return 'Publié';
            break;
            case 2:
            return 'Brouillon';
            break;
            case 3:
            return 'Supprimé';
            break;
            default:
            return false;
            break;
        }
    }
    /**
     * [getAuthorName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getAuthorName($id)
    {
        $qb = new QueryBuilder();

        $author = $qb->select('login')->from('user')->where("id", $id)->fetchOne();

        return ucfirst($author['login']);
    }

    /**
     * [dump description]
     * @param  [type]  $var  [description]
     * @param  boolean $die  [description]
     * @param  integer $type [description]
     * @return [type]        [description]
     */
    public static function dump($var, $die = false, $type = 1)
    {
        if ($type == 1) {
            highlight_string("<?php\n\$data =\n" . var_export($var, true) . ";\n?>");
        }
        if ($type == 2) {
            print_r($var);
        }
        if ($die == true) {
            die();
        }
    }
    /**
     * [humanTime description]
     * @param  [type]  $datetime [description]
     * @param  boolean $full     [description]
     * @return [type]            [description]
     */
    public static function humanTime($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'an',
            'm' => 'mois',
            'w' => 'semaine',
            'd' => 'jour',
            'h' => 'heure',
            'i' => 'minute',
            's' => 'seconde',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? 'il y a '.implode(', ', $string) : "à l'instant";
    }

    /**
     * [pageCalc description]
     * @param  [type] $count          [description]
     * @param  [type] $elementPerPage [description]
     * @return [type]                 [description]
     */
    public static function pageCalc($count, $elementPerPage)
    {
        $nbPage = $count/$elementPerPage;

        if ($count < $elementPerPage) {
            return 1;
        }

        if ($count%$elementPerPage != 0) {
            return ceil($nbPage);
        }

        return intval($nbPage);
    }

    /**
     * [img description]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public static function img($name)
    {
        return ROOT_URL.'public/img/'.$name;
    }

    /**
     * [dateDisplay description]
     * @param  [type] $date [description]
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public static function dateDisplay($date, $type)
    {
        if ($date==0) {
            $date = date("Y-m-d");
        }
        switch ($type) {
            case 1:
            return date("F j, Y", strtotime($date));
            break;
            case 2:
            return date("Y-m-d", strtotime($date));
            break;
            case 3:
            return date("m/d/Y", strtotime($date));
            break;
            case 4:
            return date("d/m/Y", strtotime($date));
            break;
            case 5:
            return self::humanTime($date);
            break;
            default:
            return false;
            break;
        }
    }

    public static function timeDisplay($time, $type)
    {
        if ($time==0) {
            $time = date("H:i");
        }
        switch ($type) {
            case 1:
            return date("g:i a", strtotime($time));
            break;
            case 2:
            return date("g:i A", strtotime($time));
            break;
            case 3:
            return date("H:i", strtotime($time));
            break;
            default:
            return false;
            break;
        }
    }

    public static function videoImg($id)
    {
        return "https://img.youtube.com/vi/".$id."/0.jpg";
    }

    public static function gravatar($email, $size = 40)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . $size;
    }

    public static function getDateType()
    {
        return [
            "1" => self::dateDisplay(0, 1),
            "2" => self::dateDisplay(0, 2),
            "3" => self::dateDisplay(0, 3),
            "4" => self::dateDisplay(0, 4),
            "5" => self::dateDisplay(0, 5),
        ];
    }
    public static function getTimeType()
    {
        return [
            "1" => self::timeDisplay(0, 1),
            "2" => self::timeDisplay(0, 2),
            "3" => self::timeDisplay(0, 3),
        ];
    }

    public static function find_shortcode($content)
    {
        $regex = "/\[(.*?)\]/";
        preg_match_all($regex, $content, $matches);

        if (empty($matches)) {
            return $content;
        } else {
            for ($i = 0; $i < count($matches[1]); $i++) {
                $match = $matches[1][$i];
                $array = explode(' ', $match);
                switch ($array[0]) {
                    case 'event':
                    $isList = strpos($array[1], ',');
                    $isInterval = strpos($array[1], '-');
                    if ($isList != false) {
                        $eventsId = explode(',', $array[1]);//liste d'id
                        $qbEvents = new QueryBuilder();
                        $qbEvents = $qbEvents->select('*');
                        $qbEvents = $qbEvents->from('event');
                        
                        for ($j=0; $j < count($eventsId); $j++) {
                            if ($j>0) {
                                $qbEvents = $qbEvents->or();
                            }
                            $qbEvents = $qbEvents->where('id', '=', $eventsId[$j]);
                        }
                        $eventList = $qbEvents->execute();
                        $renders = "";
                        foreach ($eventList as $event) {
                            $renders .= Format::render_event($event);
                        }
                        $content = str_replace($matches[0][$i], $renders, $content);
                    } elseif ($isInterval != false) {
                        //intervalle d'id
                        $eventsInter = explode('-', $array[1]);
                        $qbEvents = new QueryBuilder();
                        $qbEvents = $qbEvents->select('*');
                        $qbEvents = $qbEvents->from('event');
                        $qbEvents = $qbEvents->where('id', '>=', $eventsInter[0]);
                        $qbEvents = $qbEvents->and();
                        $qbEvents = $qbEvents->where('id', '<=', $eventsInter[1]);
                        $eventList = $qbEvents->execute();
                        
                        $renders = "";
                        foreach ($eventList as $event) {
                            $renders .= Format::render_event($event);
                        }
                        $content = str_replace($matches[0][$i], $renders, $content);
                    } else {
                        //intervalle d'id
                        $qbEvents = new QueryBuilder();
                        $qbEvents = $qbEvents->select('*');
                        $qbEvents = $qbEvents->from('event');
                        $qbEvents = $qbEvents->where('id', '=', $array[1]);
                        $event = $qbEvents->fetchOne();
                        $render = Format::render_event($event);
                        $content = str_replace($matches[0][$i], $render, $content);
                    }
                    break;
                    case 'newsletter':
                    //
                    break;

                    default:
                    # code...
                    break;
                }
            }

            return $content;
        }
    }
    public static function render_event($event)
    {
        $render = '
        <div class="row">
        <div class="col-md-12">
        <div class="col-md-6">
        ';
        if ($event['image'] != null) {
            $render .= '<img src="'.$event['image'].'" />';
        }
        $render .= '</div>
        <div class="col-md-6">
        <h1>';
        $render .= $event['name'];
        $render .= '</h1><span class="place">Lieu: ';
        $render .= $event['place'];
        $render .= '</span><span class="date">Date: ';
        $render .= $event['date'];
        $render .= '</span><p>';
        $render .= $event['description'];
        $render .= '</p>
        </div>
        </div>
        </div>';
        return $render;
    }
}
