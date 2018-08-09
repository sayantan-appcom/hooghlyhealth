<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {

public function __construct()
{
    parent::__construct();
}

public function clear_field_data() {
    $_POST = array();
    $this->_field_data = array();
    return $this;
}
}

?>