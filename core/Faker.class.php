<?php

class Faker
{
    /**
     * Pick random word from dic
     * @param  integer $nb number of word
     * @return mixed
     */
    public static function title($nb = 1)
    {
        $output = "";

        for ($i=0;$i<$nb;$i++) {
            $rand = array_rand(self::dic());
            $output .= ucfirst(self::dic()[$rand]);
            if ($nb > 1 && $i<$nb-1) {
                $output .= " ";
            }
        }

        return $output;
    }

    /**
     * Generate fake email
     * @return mixed
     */
    public static function email()
    {
        return self::firstname().self::lastname().'@gmail.com';
    }

    /**
     * Pick fake lastname form lastname dic
     * @return mixed
     */
    public static function lastname()
    {
        $rand = array_rand(self::lastnameDic());
        return self::lastnameDic()[$rand];
    }

    /**
     * Pick fake firstname from firstname dic
     * @return mixed
     */
    public static function firstname()
    {
        $rand = array_rand(self::firstnameDic());
        return self::firstnameDic()[$rand];
    }

    /**
     * Create fake full name
     * @return mixed
     */
    public static function name()
    {
        return ucfirst(self::firstname())." ".ucfirst(self::lastname());
    }

    /**
     * Create fake slug
     * @return mixed
     */
    public static function slug()
    {
        $output = "";
        $iter = rand(3, 6);

        for ($i=0;$i<$iter;$i++) {
            $output .= self::dic()[rand(0, 149)];
            if ($iter > 1 && $i<$iter-1) {
                $output .= "-";
            }
        }

        return $output;
    }

    /**
     * Get fake html from loripsum api
     * @return mixed
     */
    public static function html()
    {
        return file_get_contents('http://loripsum.net/api/10/verylong/headers/decorate/bq/ul/link');
    }

    /**
     * Get fake text from loripsum api
     * @param  integer $nb   number of paragraph
     * @param  string  $size size of the text
     * @return mixed
     */
    public static function text($nb = 1, $size = "small")
    {
        return file_get_contents('http://loripsum.net/api/plaintext/'.$size."".$size);
    }

    /**
     * Dictionnary of random words
     * @return array
     */
    public static function dic()
    {
        return explode(' ', 'lorem ipsum dolor sit amet consectetur adipiscing elit vestibulum non nulla eget quam commodo pharetra aliquam ac sollicitudin velit donec aliquam convallis nisl vel maximus nulla lacus est pharetra nec arcu et luctus congue mauris morbi rutrum eleifend gravida praesent non urna vel quam pretium efficitur non sit amet tortor integer faucibus orci a ultricies scelerisque velit ligula aliquam risus sed blandit libero enim varius dolor cras eu arcu et massa hendrerit accumsan eu non eros sed dapibus massa nec lacus malesuada tincidunt cras quis sagittis metus suspendisse ac posuere augue curabitur laoreet elit eget eros rhoncus venenatis at sed ipsum pellentesque luctus leo et rhoncus mattis morbi velit lorem, maximus ac imperdiet vel, sodales non ipsum. vivamus eget risus at lorem malesuada cursus eu sit amet urna. etiam eget elementum ipsum id consectetur mi in et facilisis urna nec auctor dui aliquam nec laoreet erat interdum et malesuada fames');
    }

    /**
     * Dictionnary of random firstname
     * @return array
     */
    public static function firstnameDic()
    {
        return explode(' ', 'tenesha verda sonja jarod elias providencia nida lanie carlton aundrea freddy jeni flor celinda veronica arthur emelina shawana jared marian jazmin palma felicita elvie dessie jaqueline giuseppina jordon daron crystle jan rufina john kendra lourie hortensia keren pearlie brianne kala rick collene elissa gayla clarence deidra deloris willene roselee abigail');
    }

    /**
     * Dictionnary of random lastname
     * @return array
     */
    public static function lastnameDic()
    {
        return explode(' ', 'benson simon mclaughlin cochran long jones moreno goodwin hahn rosario walls brandt olsen best galvan pham jarvis stevenson villa ingram hernandez pennington robbins holder gilmore buchanan haley erickson lambert castaneda vega rose green moon le stuart santana graham williams pratt wong oliver walsh french clarke dodson mitchell park bass english');
    }
}
