<?php

namespace Lib;

/**
 * Description of Request
 *
 * @author Tarek.Chida
 */
class Request {

    protected $input;
    protected $methode;
    protected $url;

    /**
     * 
     * @param type $input
     * @param type $methode
     * @param type $url
     */
    public function __construct($input, $methode, $url) { 
        $this->input = $input;
        $this->methode = $methode;
        $this->url = $url;
    }

    /**
     * Get request data or default value
     * @return type
     */
    public function getInput($name, $default = NULL) {
        return !empty($this->input[$name]) ? $this->input[$name] : $default;
    }

    /**
     * 
     * @return type
     */
    public function getInputArray() {
        return $this->input;
    }

    /**
     * 
     * @return type
     */
    public function getMethode() {
        return $this->methode;
    }

    /**
     * 
     * @return type
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * 
     * @param type $input
     */
    public function setInput($input) {
        $this->input = $input;
    }

    /**
     * 
     * @param type $methode
     */
    public function setMethode($methode) {
        $this->methode = $methode;
    }

    /**
     * 
     * @param type $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

}
