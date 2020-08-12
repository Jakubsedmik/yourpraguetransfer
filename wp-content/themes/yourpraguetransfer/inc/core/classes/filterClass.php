<?php


class filterClass
{
    protected $operator;
    protected $value1;
    protected $value2;

    public function __construct($value1, $operator, $value2)
    {
        $this->operator = $operator;
        $this->value1 = $value1;
        $this->value2 = $value2;
    }


    public function createCondition(){
        return $this->value1 . " " . $this->operator . " " . $this->value2;
    }



}