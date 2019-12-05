<?php require_once('Model.php'); ?>
<?php

class Schedules
{
    private $ppdfc_id;
    private $car_id;
    private $user_id;
    private $day;
    private $morning;
    private $evening;

    public function __construct($args)
    {
        if (!is_array($args)) {
            throw new Exception('Rating constructor requires an array');
        }
        $this->ppdfc_id = $args['ppdfc_id'] ?? NULL;
        $this->car_id   = $args['car_id']   ?? NULL;
        $this->user_id  = $args['user_id']  ?? NULL;
        $this->day      = $args['day']      ?? NULL;
        $this->morning  = $args['morning']  ?? NULL;
        $this->evening  = $args['evening']  ?? NULL;
    }

    public function getPpdfc_id()
    {
        return $this->ppdfc_id;
    }
    public function getCar_id()
    {
        return $this->car_id;
    }
    public function getUer_id()
    {
        return $this->user_id;
    }
    public function getDay()
    {
        return $this->day;
    }
    public function getMorning()
    {
        return $this->morning;
    }
    public function getEvening()
    {
        return $this->evening;
    }

    public function setPpdfc_id($ppdfc_id)
    {
        if ($ppdfc_id === NULL) {
            $this->ppdfc_id = NULL;
            return;
        }
        $this->ppdfc_id = $ppdfc_id;
    }
    public function setCar_id($car_id)
    {
        if ($car_id === NULL) {
            $this->car_id = NULL;
            return;
        }
        $this->car_id = $car_id;
    }
    public function setUser_id($user_id)
    {
        if ($user_id === NULL) {
            $this->user_id = NULL;
            return;
        }
        $this->user_id = $user_id;
    }
    public function setDay($day)
    {
        if ($day === NULL) {
            $this->day = NULL;
            return;
        }
        $this->day = $day;
    }
    public function setMorning($morning)
    {
        if ($morning === NULL) {
            $this->morning = NULL;
            return;
        }
        $this->morning = $morning;
    }
    public function setEvening($evening)
    {
        if ($evening === NULL) {
            $this->evening = NULL;
            return;
        }
        $this->evening = $evening;
    }


}
?>