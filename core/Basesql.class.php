<?php
class Basesql
{
    private $table;
    protected $pdo;
    private $columns = [];
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->table = strtolower(get_called_class());

        $this->pdo = Singleton::getDB();

        $all_vars = get_object_vars($this);
        $class_vars = get_class_vars(get_class());
        $this->columns = array_keys(array_diff_key($all_vars, $class_vars));
    }
    /**
     * [setColumns description]
     */
    public function setColumns()
    {
        $this->columns = array_diff_key(
        get_object_vars($this),
        get_class_vars(get_class())
      );
    }

    /**
     * [save description]
     * @return [type] [description]
     */
    public function save()
    {
        global $debug;

        $this->setColumns();

        if ($this->updateOnKey()) {
            foreach ($this->columns as $key => $value) {
                if (isset($value)) {
                    $sqlSet[] = $key."=:".$key;
                } else {
                    unset($this->columns[$key]);
                }
            }

            $query = $this->pdo->prepare(" UPDATE ".$this->table." SET ".implode(", ", $sqlSet)." WHERE ".$this->getPkStr()."=:".$this->getPkStr()." ");

            $query->execute($this->columns);
        } else {
            unset($this->columns['id']);

            $query = $this->pdo->prepare("
          INSERT INTO ".$this->table." 
          (". implode(",", array_keys($this->columns)) .")
          VALUES
          (:". implode(",:", array_keys($this->columns)) .")
          ");

            $query->execute($this->columns);
            $this->id = $this->pdo->lastInsertId();
        }
    }
    /**
     * [delete description]
     * @return [type] [description]
     */
    public function delete()
    {
        $this->setColumns();

        $query = $this->pdo->prepare("DELETE FROM ".$this->table." WHERE id=:id ");
        $query->execute(array("id" => $this->columns["id"]));
    }

    public function initDb()
    {
        $sql = file_get_contents('init.sql');
        $qr = $this->pdo->exec($sql);
    }
    /**
     * [delete description]
     * @return [type] [description]
     */
    public function flagDelete()
    {
        $this->setColumns();
        $query = $this->pdo->prepare("UPDATE ".$this->table." SET status= 5 WHERE id=:id");
        $query->execute(array("id" => $this->columns["id"]));
    }
    /**
     * [delete description]
     * @return [type] [description]
     */
    public function cleanUserSlugPasswordRecovery()
    {
        $this->setColumns();

        $query = $this->pdo->prepare("DELETE passwordrecovery, slug  
       FROM passwordrecovery
       INNER JOIN slug 
       ON slug.slug = passwordrecovery.slug
       WHERE passwordrecovery.user_id  =:id");

        $query->execute(array("id" => $this->columns["id"]));
    }
    /**
     * [deleteSlugReference description]
     * @param  [type] $table  [description]
     * @param  [type] $target [description]
     * @return [type]         [description]
     */
    public function deleteSlugReference($table, $target)
    {
        $query = $this->pdo->prepare("DELETE " . $table . ", slug  
       FROM " . $table . "
       INNER JOIN slug 
       ON slug.slug = " . $table . ".slug
       WHERE " . $table . ".slug  =:slug");

        $query->execute(array("slug" => " . $target . "));
    }

    /**
     * [deleteSlugReference description]
     * @param  [type] $table  [description]
     * @param  [type] $target [description]
     * @return [type]         [description]
     */
    public function getData($table, $condition = [], $operator = [], $orderby = "", $groupby = "", $limit = [], $columns = "*")
    {
        $sql = 'SELECT '. $columns .' FROM '.$table.' ';

        if (!empty($condition)) {
            $sql .='WHERE ';

            foreach ($condition as $key => $value) {
                if (is_array($value)) {
                    $i = 0;
                    foreach ($value as $subvalue) {
                        if (is_string($subvalue)) {
                            $list_of_conditions[] = $key."= :".$key.$i;
                        } else {
                            switch ($subvalue[0]) {
                  case 'NOW()':
                  $list_of_conditions[] = $key.' '.$subvalue[1].' NOW()';
                  break;
                  case $subvalue[1]=='LIKE':
                  $list_of_conditions[] = $key.' '.$subvalue[1].' \'%'.$subvalue[0].'%\' ';
                  break;
                  case is_int($subvalue[0]) || is_string($subvalue[0]):
                  $list_of_conditions[] = $key.' '.$subvalue[1].' :'.$key.$i;
                  break;

                }
                            $condition[$key.$i] = $subvalue[0];
                        }
                        $i++;
                    }
                } else {
                    if (is_string($value)) {
                        $list_of_conditions[] = $key."= :".$key;
                    } else {
                        switch ($value[0]) {
                case 'NOW()':
                $list_of_conditions[] = $key.' '.$value[1].' NOW()';
                break;
                case $value[1]=='LIKE':
                $list_of_conditions[] = $key.' '.$value[1].' \'%'.$value[0].'%\' ';
                break;
                case is_int($value[0]) || is_string($value[0]):
                $list_of_conditions[] = $key.' '.$value[1].' :'.$key;
                break;

              }
                        $condition[$key] = $value[0];
                    }
                }
            }

            if (count($operator)+1 == count($condition)) {
                $i=0;
                foreach ($list_of_conditions as $conditions) {
                    if ($i < count($operator)) {
                        $sql .= $conditions.' '.$operator[$i].' ';
                    } else {
                        $sql .= $conditions.' ';
                    }
                    $i++;
                }
            } else {
                $sql .= implode(" AND ", $list_of_conditions);
            }
        }
        if (!empty($orderby)) {
            $sql .=' ORDER BY '.$orderby;
        }
        if (!empty($groupby)) {
            $sql .=' GROUP BY '.$orderby;
        }
        if (!empty($limit)) {
            $sql .=' LIMIT '.$limit[0].', '.$limit[1];
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($condition);
        return $query->fetchAll();
    }

    /**
     * [slugExists description]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public static function slugExists($slug)
    {
        return in_array($slug, Slug::getSlugTable());
    }
    /**
     * [userDisplayFilters description]
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function userDisplayFilters($filter)
    {
        switch ($filter) {
        case 1:
        $this->openBracket()
        ->where('status', '!=', 5)
        ->or()
        ->where('status', '!=', 2)
        ->closeBracket()
        ->and()
        ->where('role', 5);
        break;
        case 2:
        $this
        ->openBracket()
        ->where('status', '!=', 5)
        ->or()
        ->where('status', '!=', 2)
        ->closeBracket()
        ->and()
        ->where('role', 2);
        break;
        case 3:
        $this
        ->openBracket()
        ->where('status', '!=', 5)
        ->or()
        ->where('status', '!=', 2)
        ->closeBracket()
        ->and()
        ->where('role', 3);
        break;
        case 4:
        $this
        ->openBracket()
        ->where('status', '!=', 5)
        ->or()
        ->where('status', '!=', 2)
        ->closeBracket()
        ->and()
        ->where('role', 4);
        break;
        case 5:
        $this->where('status', 5);
        break;
      }
        return $this;
    }
    /**
     * [userDisplaySorting description]
     * @param  [type] $sort [description]
     * @return [type]       [description]
     */
    public function userDisplaySorting($sort)
    {
        switch ($sort) {
        case 1:
        $this->OrderBy('login', 'DESC');
        break;
        case -1:
        $this->OrderBy('login', 'ASC');
        break;
        case 2:
        $this->OrderBy('lastname', 'DESC');
        break;
        case -2:
        $this->OrderBy('lastname', 'ASC');
        break;
        case 3:
        $this->OrderBy('email', 'ASC');
        break;
        case -3:
        $this->OrderBy('email', 'DESC');
        break;
        case 4:
        $this->OrderBy('role', 'DESC');
        break;
        case -4:
        $this->OrderBy('role', 'ASC');
        break;
        default:
        return $this;
        break;
      }
        return $this;
    }
    /**
     * [articleDisplayFilters description]
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function articleDisplayFilters($filter)
    {
        switch ($filter) {
        case 1:
        $this->and()->where('status', 1);
        break;
        case 2:
        $this->and()->where('status', 2);
        break;
      }
        return $this;
    }
    /**
     * [pageDisplayFilters description]
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function pageDisplayFilters($filter)
    {
        switch ($filter) {
        case 1:
        $this->and()->where('status', 1);
        break;
      }
        return $this;
    }
    /**
     * [commentDisplayFilters description]
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function commentDisplayFilters($filter)
    {
        switch ($filter) {
        case 1:
        $this->where('comment.status', 2);
        break;
        case 2:
        $this->where('comment.status', 1);
        break;
        case 3:
        $this->where('comment.status', 3);
        break;
        case 4:
        $this->where('comment.status', 4);
        break;
        case 5:
        $this->where('comment.status', 5);
        break;
      }
        return $this;
    }
}
