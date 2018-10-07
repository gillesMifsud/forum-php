<?php


namespace App;

class Validator
{
    private $data;
    private $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }



    private function getField($field)
    {
        if (!isset($this->data[$field])) {
            return null;
        }
        return $this->data[$field];
    }



    // verif si le champ est aplha
    public function isAlpha($field, $errorMsg){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $this->getField($field)[)){
            $this->errors[$field] = $errorMsg;
        }
    }



    // verif si le champ est unique
    public function isUnique($field, $errorMsg){
        $user = App::getDb()->queryOne("SELECT ID_USER FROM user WHERE $field = ?", $errorMsg);
    }



    public function isEmail($field, $errorMsg = false)
    {
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }


    // verif pass
    public function isConfirmed($field, $errorMsg){

       $value = $this->getField($field);

       if(empty($value) || $value != $this->getField($field . '_confirm')) {

           $this->errors[$field] = $errorMsg;

        }
    }



    public function isValid()
    {
        return empty($this->errors);
    }



    public function getErrors()
    {
        return $this->errors;
    }

}