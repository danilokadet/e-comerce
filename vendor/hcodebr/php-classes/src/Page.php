<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hcode;
use Rain\Tpl;
/**
 * Description of Page
 *
 * @author DELL
 */
class Page {
    
    private $tpl;
    private $options = [];
    private $defaults = [
        
        "data" => []
    ];
    public function __construct($opts = array()) {
      
        $this->options = array_merge($this->defaults, $opts);
        $config = array(
            "tpl_dir"    => $_SERVER["DOCUMENT_ROOT"]."/views/",
            "cache_dir"  => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"      => false // set to false to improve the speed
        );

	Tpl::configure( $config );
        $this->tpl = new Tpl;
        
        $this->setData($this->options["data"]);
        
        $this->tpl->draw("header");
    }
    
    private function setData($data = array())
    {
        foreach ($data as $key => $value) {
            
            $this->tpl->assign($key, $value);
        }
    }


    public function setTpl($name, $data = array(), $returnHtml = false)
    {
        $this->setData($data);
        return $this->tpl->draw($name, $returnHtml);
    }
    
    
    public function __destruct() {
        
        $this->tpl->draw("footer");
    }
}
