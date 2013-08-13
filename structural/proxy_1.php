<?php

class CD {
    protected $_title = ''; 
    protected $_band = ''; 
    protected $_handle = null;

    public function __construct($title, $band) {
        
        $this->_title = $title;
        $this->_band = $band;
    }

    public function buy() {
        
        $this->_connect();
        $query = "update CDs set bought = 1 where band = '";
        $query .= mysql_real_escape_string($this->_band, $this->_handle);
        $query .= "' and title = '";
        $query .= mysql_real_escape_string($this->_title, $this->_handle);
        $query .= "'";
        mysql_query($query, $this->_handle);
    }

    protected function _connect() {
        
        $this->_handle = mysql_connect('localhost ', 'user ', 'pass');
        mysql_select_db('CD ', $this->_handle);
    }
}

$externalTitle = 'Waste of a Rib';
$externalBand = 'Never Again';
$cd = new CD($externalTitle, $externalBand);
$cd->buy();

class DallasNOCCDProxy extends CD {

    protected function _connect() {
        
        $this->_handle = mysql_connect('dallas ', 'user ', 'pass');
        mysql_select_db('CD');
    }

}

$externalTitle = 'Waste of a Rib'; 
$externalBand = 'Never Again';
$cd = new DallasNOCCDProxy($externalTitle, $externalBand);
$cd->buy();