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
      $this->pdo->exec("
        CREATE TABLE `category` 
        (`id` int(11) NOT NULL,
        `label` varchar(45) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `slug` varchar(200) DEFAULT NULL) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("INSERT INTO `category` 
        (`id`, `label`, `type`, `slug`) VALUES
        (1, 'non classé', 3, 'non-classe')");
      $this->pdo->exec("CREATE TABLE `comment` (
        `id` int(11) NOT NULL,
        `body` text NOT NULL,
        `created_at` datetime NOT NULL,
        `status` tinyint(4) NOT NULL,
        `post_id` int(11) NOT NULL,
        `user_id` int(11) DEFAULT NULL,
        `type` int(11) NOT NULL,
        `email` varchar(255) DEFAULT NULL,
        `name` varchar(100) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `event` (
        `id` int(11) NOT NULL,
        `name` varchar(45) NOT NULL,
        `place` varchar(150) DEFAULT NULL,
        `externalurl` varchar(500) DEFAULT NULL,
        `description` varchar(500) NOT NULL,
        `date` datetime NOT NULL,
        `image` varchar(255) DEFAULT NULL,
        `body` text NOT NULL,
        `user_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `join_article_category` (
        `id` int(11) NOT NULL,
        `category_id` int(11) NOT NULL,
        `post_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `media` (
        `id` int(11) NOT NULL,
        `name` varchar(125) NOT NULL,
        `path` varchar(500) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `caption` varchar(255) NOT NULL,
        `alttext` varchar(255) NOT NULL,
        `description` varchar(255) NOT NULL,
        `url` varchar(500) NOT NULL,
        `user_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `navbar` (
        `id` int(11) NOT NULL,
        `name` varchar(45) DEFAULT NULL,
        `title` varchar(45) DEFAULT NULL,
        `url` varchar(500) DEFAULT NULL,
        `content_type` int(11) DEFAULT NULL,
        `content_id` int(11) DEFAULT NULL,
        `slug` varchar(200) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `newsletter` (
        `id` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `body` text NOT NULL,
        `description` varchar(255) DEFAULT NULL,
        `created_at` datetime DEFAULT NULL,
        `published_at` datetime DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        `user_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `passwordrecovery` (
        `id` int(11) NOT NULL,
        `token` varchar(255) NOT NULL,
        `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        `user_id` int(11) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `slug` varchar(200) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `post` (
        `id` int(11) NOT NULL,
        `title` varchar(45) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `slug` varchar(200) NOT NULL,
        `content` text NOT NULL,
        `excerpt` varchar(255) DEFAULT NULL,
        `image` varchar(255) DEFAULT NULL,
        `description` varchar(500) DEFAULT NULL,
        `created_at` datetime NOT NULL,
        `published_at` datetime NOT NULL,
        `status` tinyint(4) NOT NULL,
        `parent` int(11) DEFAULT NULL,
        `user_id` int(11) NOT NULL,
        `visibility` tinyint(4) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `setting` (
        `id` varchar(45) NOT NULL,
        `type` int(11) NOT NULL,
        `value` varchar(255) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `slug` (
        `slug` varchar(200) NOT NULL,
        `type` tinyint(4) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("INSERT INTO `slug` (`slug`, `type`) 
        VALUES
        ('non-classe', 1)");
      $this->pdo->exec("CREATE TABLE `stat` (
        `id` int(11) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `date` datetime NOT NULL,
        `ip` varchar(100) DEFAULT NULL,
        `useragent` text DEFAULT NULL,
        `referer` text DEFAULT NULL,
        `content_type` int(11) DEFAULT NULL,
        `content_id` int(11) DEFAULT NULL,
        `body` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `theme` (
        `id` int(11) NOT NULL,
        `title` varchar(45) NOT NULL,
        `version` varchar(45) NOT NULL,
        `author` varchar(150) NOT NULL,
        `active` tinyint(4) NOT NULL,
        `path` varchar(100) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("CREATE TABLE `user` (
        `id` int(11) NOT NULL,
        `login` varchar(255) NOT NULL,
        `lastname` varchar(45) DEFAULT NULL,
        `firstname` varchar(45) NOT NULL,
        `role` tinyint(4) NOT NULL,
        `email` varchar(45) NOT NULL,
        `password` varchar(255) DEFAULT NULL,
        `created_at` datetime NOT NULL,
        `status` tinyint(4) NOT NULL,
        `token` varchar(200) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
      $this->pdo->exec("ALTER TABLE `category`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_category_slug1_idx` (`slug`)");
      $this->pdo->exec("ALTER TABLE `comment`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_comment_post1_idx` (`post_id`),
        ADD KEY `fk_comment_user1_idx` (`user_id`)");
      $this->pdo->exec("ALTER TABLE `event`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_event_user1_idx` (`user_id`)");
      $this->pdo->exec("ALTER TABLE `join_article_category`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_join_article_category_category1_idx` (`category_id`),
        ADD KEY `fk_join_article_category_post1_idx` (`post_id`)");
      $this->pdo->exec("ALTER TABLE `media`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_media_user1_idx` (`user_id`)");
      $this->pdo->exec("ALTER TABLE `navbar`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_navbar_slug1_idx` (`slug`)");
      $this->pdo->exec("ALTER TABLE `newsletter`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_newsletter_user1_idx` (`user_id`)");
      $this->pdo->exec("ALTER TABLE `passwordrecovery`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_passwordrecovery_user1_idx` (`user_id`),
        ADD KEY `fk_passwordrecovery_slug1_idx` (`slug`)");
      $this->pdo->exec("ALTER TABLE `post`
        ADD PRIMARY KEY (`id`),
        ADD KEY `fk_page_user1_idx` (`user_id`),
        ADD KEY `fk_post_slug1_idx` (`slug`)");
      $this->pdo->exec("ALTER TABLE `setting`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `key_UNIQUE` (`id`)");
      $this->pdo->exec("ALTER TABLE `slug`
        ADD PRIMARY KEY (`slug`)");
      $this->pdo->exec("ALTER TABLE `stat`
        ADD PRIMARY KEY (`id`)");
      $this->pdo->exec("ALTER TABLE `theme`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `path_UNIQUE` (`path`)");
      $this->pdo->exec("ALTER TABLE `user`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `login_UNIQUE` (`login`),
        ADD UNIQUE KEY `email_UNIQUE` (`email`)");
      $this->pdo->exec("ALTER TABLE `category`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24");
      $this->pdo->exec("ALTER TABLE `comment`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10");
      $this->pdo->exec("ALTER TABLE `event`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
      $this->pdo->exec("ALTER TABLE `join_article_category`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81");
      $this->pdo->exec("ALTER TABLE `media`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
      $this->pdo->exec("ALTER TABLE `navbar`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
      $this->pdo->exec("ALTER TABLE `newsletter`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
      $this->pdo->exec("ALTER TABLE `passwordrecovery`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5");
      $this->pdo->exec("ALTER TABLE `post`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60");
      $this->pdo->exec("ALTER TABLE `stat`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60262");
      $this->pdo->exec("ALTER TABLE `theme`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
      $this->pdo->exec("ALTER TABLE `user`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21");
      $this->pdo->exec("ALTER TABLE `category`
        ADD CONSTRAINT `fk_category_slug1` FOREIGN KEY (`slug`) REFERENCES `slug` (`slug`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `comment`
        ADD CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `event`
        ADD CONSTRAINT `fk_event_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `join_article_category`
        ADD CONSTRAINT `fk_join_article_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_join_article_category_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `media`
        ADD CONSTRAINT `fk_media_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `navbar`
        ADD CONSTRAINT `fk_navbar_slug1` FOREIGN KEY (`slug`) REFERENCES `slug` (`slug`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `newsletter`
        ADD CONSTRAINT `fk_newsletter_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `passwordrecovery`
        ADD CONSTRAINT `fk_passwordrecovery_slug1` FOREIGN KEY (`slug`) REFERENCES `slug` (`slug`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_passwordrecovery_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("ALTER TABLE `post`
        ADD CONSTRAINT `fk_page_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_post_slug1` FOREIGN KEY (`slug`) REFERENCES `slug` (`slug`) ON DELETE NO ACTION ON UPDATE NO ACTION");
      $this->pdo->exec("INSERT INTO `setting` (`id`, `type`, `value`) VALUES
        ('comments', 1, '1'),
        ('datetype', 1, '1'),
        ('default-cat', 2, '1'),
        ('default-format', 2, '1'),
        ('display-post', 3, '1'),
        ('email', 1, ''),
        ('favicon', 1, ''),
        ('homepage', 3, '0'),
        ('left-1', 4, 'welcome-block'),
        ('left-2', 4, 'links-block'),
        ('left-3', 4, 'activity'),
        ('left-4', 4, 'comments'),
        ('left-5', 4, 'NULL'),
        ('right-1', 4, 'stats'),
        ('right-2', 4, 'quickview'),
        ('right-3', 4, 'NULL'),
        ('right-4', 4, 'NULL'),
        ('right-5', 4, 'NULL'),
        ('links-bloc', 4, '1'),
        ('mail-login', 2, ''),
        ('mail-password', 2, ''),
        ('mail-port', 2, ''),
        ('mail-server', 2, ''),
        ('pagination-posts', 3, '1'),
        ('pagination-rss', 3, '1'),
        ('signup', 2, '2'),
        ('slogan', 1, ''),
        ('theme', 5, 'default'),
        ('timetype', 1, '1'),
        ('timezone', 2, '1'),
        ('title', 1, ''),
        ('url', 1, ''),
        ('welcome-bloc', 4, '1')");
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
