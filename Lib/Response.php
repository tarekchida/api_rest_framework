<?php

namespace Lib;

/**
 * Description of Response
 *
 * @author Tarek.Chida
 */
class Response {

    protected $status;
    protected $message;
    protected $data;

    /**
     * 
     * @param type $status
     * @param type $message
     * @param type $data
     */
    public function __construct($status = 200, $message = NULL, $data = NULL) {
        header("Content-Type:application/json");
        http_response_code($status);
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * 
     * @return type
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * 
     * @return type
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * 
     * @return type
     */
    public function getData() {
        return $this->data;
    }

    /**
     * 
     * @return type
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * 
     * @return type
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * 
     * @return type
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * 
     * @return type
     */
    public function toJSON() {
        return json_encode(array(
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ));
    }

}
