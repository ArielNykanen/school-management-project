<?php
    require_once 'app/dal/dal.php';

 class BusinessLogic 
{
    protected $dal;

    public function __construct() 
    {
        $this->dal = DataAccessLayer::Instance();
    }

}

?>