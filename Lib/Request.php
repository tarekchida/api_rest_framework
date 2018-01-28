<?php

namespace Lib;

/**
 * Description of Request
 *
 * @author Tarek.Chida
 */
class Request {

    protected $input;
    protected $method;
    protected $url;

    /**
     * 
     * @param type $input
     * @param type $method
     * @param type $url
     */
    public function __construct($input, $method, $url) { 
        $this->input = $input;
        $this->method = $method;
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
        return $this->method;
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
     * @param type $method
     */
    public function setMethode($method) {
        $this->method = $method;
    }

    /**
     * 
     * @param type $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

}
