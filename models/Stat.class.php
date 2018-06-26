<?php 
class Stat extends StatRepository
{
    protected $id;
    protected $type;
    protected $date;
    protected $body;
    protected $ip;
    protected $useragent;
    protected $referer;
    protected $content_type;
    protected $content_id;

    public function updateOnKey(){
        return $this->id;
    }
    public function getPkStr(){
        return "id";
    }
    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date="")
    {
        if (empty($date)) {
            $this->date = date("Y-m-d H:i:s");
        } else {
            $this->date = $date;
        }
        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip = "")
    {
        if (empty($ip)) {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $this->ip = $ip;
        }

        return $this;
    }

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
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->useragent = $this->pdo->quote($_SERVER['HTTP_USER_AGENT']);
        }

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
        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->referer = $this->pdo->quote($_SERVER['HTTP_REFERER']);
        }

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
}
