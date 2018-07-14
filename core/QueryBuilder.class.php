<?php

class QueryBuilder extends Basesql
{
    private $query = "";
    private $selector = "";
    private $table = "";
    private $where = "";
    private $set = "";
    private $order = "";
    private $limit = "";
    private $join = "";
    private $groupBy = "";
    private $parameters = [];

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * [select description]
     * @param  [type] $columns [description]
     * @return [type]          [description]
     */
    public function select($columns)
    {
        $this->selector .= "SELECT ";
        
        if (is_array($columns)) {
            $lastElement = count($columns);
            $i = 1;
            foreach ($columns as $column) {
                $this->selector .= $column;
                if ($i != $lastElement) {
                    $this->selector .= ", ";
                } else {
                    $this->selector .= " ";
                }
                $i++;
            }
        } else {
            $this->selector .= $columns." ";
        }
        return $this;
    }
    /**
     * [delete description]
     * @param  string $table [description]
     * @return [type]        [description]
     */
    public function delete($table = "")
    {
        if (empty($table)) {
            $this->selector .= "DELETE";
        } else {
            $this->selector .= "DELETE ".$table." ";
        }
        
        return $this;
    }
    /**
     * [update description]
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    public function update($table)
    {
        $this->selector .= "UPDATE ".$table." ";
        return $this;
    }
    /**
     * [findAll description]
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    public function findAll($table)
    {
        $this->selector = "SELECT *";
        $this->table = $table." ";

        return $this;
    }
    /**
     * [count description]
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    public function count($table)
    {
        $this->reset();
        $this->selector = "SELECT COUNT(*)";
        $this->table = $table." ";

        return $this;
    }
    /**
     * [all description]
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    public function all($table)
    {
        $this->selector = "SELECT *";
        $this->table = $table." ";

        return $this;
    }
    /**
     * [from description]
     * @param  [type] $table [description]
     * @param  string $alias [description]
     * @return [type]        [description]
     */
    public function from($table, $alias = "")
    {
        $this->table .= " ".$table." ";
        if (!empty($alias)) {
            $this->table .= "AS ".$alias." ";
        }
        return $this;
    }
    /**
     * [openBracket description]
     * @return [type] [description]
     */
    public function openBracket()
    {
        $this->where .= " (";
        return $this;
    }
    /**
     * [closeBracket description]
     * @return [type] [description]
     */
    public function closeBracket()
    {
        $this->where .= ") ";
        return $this;
    }
    /**
     * [addWhere description]
     * @param [type] $where [description]
     */
    public function addWhere($where)
    {
        $this->where .= " ".$where." ";
        return $this;
    }
    /**
     * [where description]
     * @param  [type] $column   [description]
     * @param  [type] $operator [description]
     * @param  [type] $value    [description]
     * @return [type]           [description]
     */
    public function where($column, $operator, $value = null)
    {
        if (!isset($value)) {
            $value = $operator;
            $operator = "=";
        }
        $preparedVar = uniqid();
        $this->where .= " ".$column." ".$operator." :".$preparedVar." ";
        $this->parameters[$preparedVar] = $value;
        return $this;
    }
    /**
     * [search description]
     * @param  [type] $column [description]
     * @param  [type] $value  [description]
     * @return [type]         [description]
     */
    public function search($column, $value = null)
    {
        $preparedVar = uniqid();
        $this->where .= " ".$column." LIKE CONCAT('%',:".$preparedVar.",'%') ";
        $this->parameters[$preparedVar] = $value;
        return $this;
    }
    /**
     * [set description]
     * @param [type] $values [description]
     */
    public function set($values)
    {
        $this->set .= " ".$values." ";
        return $this;
    }
    /**
     * [setLike description]
     * @param [type] $parameter [description]
     * @param [type] $value     [description]
     */
    public function setLike($parameter, $value)
    {
        $this->parameters[$parameter] = '%'.$value.'%';
        return $this;
    }
    /**
     * [setParameter description]
     * @param [type] $parameter [description]
     * @param [type] $value     [description]
     */
    public function setParameter($parameter, $value)
    {
        $this->parameters[$parameter] = $value;
        return $this;
    }
    /**
     * [addSeparator description]
     * @param [type] $separator [description]
     */
    public function addSeparator($separator)
    {
        $this->where .= " ".$separator." ";
        return $this;
    }
    /**
     * [or description]
     * @return [type] [description]
     */
    public function or()
    {
        $this->where .= " OR ";
        return $this;
    }
    /**
     * [and description]
     * @return [type] [description]
     */
    public function and()
    {
        $this->where .= " AND ";
        return $this;
    }
    /**
     * [orderBy description]
     * @param  [type] $column [description]
     * @param  [type] $order  [description]
     * @return [type]         [description]
     */
    public function orderBy($column, $order)
    {
        $this->order .= " ".$column." ".$order." ";
        return $this;
    }
    /**
     * [limit description]
     * @param  [type] $limit  [description]
     * @param  [type] $offset [description]
     * @return [type]         [description]
     */
    public function limit($limit, $offset)
    {
        $this->limit .= " ".$limit.", ".$offset;
        return $this;
    }
    /**
     * [leftJoin description]
     * @param  [type] $table     [description]
     * @param  [type] $condition [description]
     * @return [type]            [description]
     */
    public function leftJoin($table, $condition)
    {
        $this->join .= "LEFT JOIN ".$table;
        $this->join .= " ON ".$condition." ";
        return $this;
    }
    /**
     * [join description]
     * @param  [type] $table     [description]
     * @param  [type] $condition [description]
     * @return [type]            [description]
     */
    public function join($table, $condition)
    {
        $this->join .= "JOIN ".$table;
        $this->join .= " ON ".$condition." ";
        return $this;
    }

    /**
     * [innerJoin description]
     * @param  [type] $table     [description]
     * @param  [type] $condition [description]
     * @return [type]            [description]
     */
    public function innerJoin($table, $condition)
    {
        $this->join .= "INNER JOIN ".$table;
        $this->join .= " ON ".$condition." ";
        return $this;
    }
    /**
     * [debug description]
     * @return [type] [description]
     */
    public function debug()
    {
        return $this;
    }
    /**
     * [dump description]
     * @return [type] [description]
     */
    public function dump()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
            $this->selector
            ." FROM ".$this->table
            .(!empty($this->join)?$this->join:"")
            .(!empty($this->where)?"WHERE".$this->where:"")
            .(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
            .(!empty($this->order)?"ORDER BY".$this->order:"")
            .(!empty($this->limit)?"LIMIT".$this->limit:"");

            return $this->query;
        }
    }
    /**
     * [groupBy description]
     * @param  [type] $group [description]
     * @return [type]        [description]
     */
    public function groupBy($group)
    {
        $this->groupBy .= " ".$group." ";
        return $this;
    }
    /**
     * [reset description]
     * @return [type] [description]
     */
    public function reset()
    {
        $this->query = "";
        $this->selector = "";
        $this->table = "";
        $this->where = "";
        $this->set = "";
        $this->order = "";
        $this->limit = "";
        $this->groupBy = "";
        $this->join = "";
        $this->parameters = [];
        return $this;
    }
    /**
     * [execute description]
     * @return [type] [description]
     */
    public function execute()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
            $this->selector
            ." FROM ".$this->table
            .(!empty($this->join)?$this->join:"")
            .(!empty($this->where)?"WHERE".$this->where:"")
            .(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
            .(!empty($this->order)?"ORDER BY".$this->order:"")
            .(!empty($this->limit)?"LIMIT".$this->limit:"");

            $query = $this->pdo->prepare($this->query);
            $query->execute($this->parameters);
            return $query->fetchAll();
        }
    }
    /**
     * [get description]
     * @return [type] [description]
     */
    public function get()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
            $this->selector
            ." FROM ".$this->table
            .(!empty($this->join)?$this->join:"")
            .(!empty($this->where)?"WHERE".$this->where:"")
            .(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
            .(!empty($this->order)?"ORDER BY".$this->order:"")
            .(!empty($this->limit)?"LIMIT".$this->limit:"");

            $query = $this->pdo->prepare($this->query);
            $query->execute($this->parameters);
            return $query->fetchAll();
        }
    }
    /**
     * [paginate description]
     * @param  [type] $perPage [description]
     * @return [type]          [description]
     */
    public function paginate($perPage, $getPage = "")
    {
        $total = count($this->get());

        $nbPage = Format::pageCalc($total, $perPage);

        if (empty($getPage)) {
            $current = Singleton::request()->getParam('p');
        } else {
            $current = $getPage;
        }

        if ($current == null && $nbPage > 0) {
            $current = '1';
        }

        if ($current == 1) {
            $this->limit('0', $perPage);
        } else {
            $this->limit($current*$perPage-$perPage, $perPage);
        }

        Singleton::request()->setPaginate($total, $nbPage, $perPage, $current);
        
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
            $this->selector
            ." FROM ".$this->table
            .(!empty($this->join)?$this->join:"")
            .(!empty($this->where)?"WHERE".$this->where:"")
            .(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
            .(!empty($this->order)?"ORDER BY".$this->order:"")
            .(!empty($this->limit)?"LIMIT".$this->limit:"");

            $query = $this->pdo->prepare($this->query);
            $query->execute($this->parameters);
            return $query->fetchAll();
        }
    }

    /**
     * [save description]
     * @return [type] [description]
     */
    public function save()
    {
        if (!isset($this->selector) || !isset($this->table)) {
            return false;
        } else {
            $this->query =
            $this->selector
            ." SET ".$this->set
            .(!empty($this->join)?$this->join:"")
            .(!empty($this->where)?"WHERE".$this->where:"")
            .(!empty($this->groupBy)?"GROUP BY".$this->groupBy:"")
            .(!empty($this->order)?"ORDER BY".$this->order:"")
            .(!empty($this->limit)?"LIMIT".$this->limit:"");
            $query = $this->pdo->prepare($this->query);
            $query->execute($this->parameters);
            return $query->fetchAll();
        }
    }

    /**
     * [fetchOne description]
     * @return [type] [description]
     */
    public function fetchOne()
    {
        $result = $this->execute();

        if (empty($result)) {
            return $result;
        } else {
            return $result[0];
        }
    }

    /**
     * [fetchOrFail description]
     * @return [type] [description]
     */
    public function fetchOrFail()
    {
        $result = $this->execute();

        if (empty($result)) {
            Route::redirect('Error404');
        } else {
            return $result[0];
        }
    }
    
    /**
     * [getCol description]
     * @return [type] [description]
     */
    public function getCol()
    {
        $result = $this->execute();

        if (empty($result)) {
            return $result;
        } else {
            return $result[0][0];
        }
    }
}
