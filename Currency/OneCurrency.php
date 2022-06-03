<?php

namespace Currency;

class OneCurrency
{

    public function __construct($data) 
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }
}