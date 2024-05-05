<?php
class CounterService
{
    public function setCounter($count)
    {
        $_SESSION["count"] = $count;
    }
    public function getCounter()
    {

        if (isset($_SESSION["count"])) {
            return $_SESSION["count"];
        }
        return 0;
    }
}

$counterService = new CounterService();