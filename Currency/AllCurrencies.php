<?php

namespace Currency;

class AllCurrencies
{

    public $data;

    public function addCurrency(OneCurrency $currency) 
    {
        $this->data[] = $currency;
    }

    public function getByKey(string $key, string $value): OneCurrency
    {
        $result = current(array_filter($this->data, function($item) use ($key, $value) {return $item->$key == $value;}));

        if (getttype($result) == 'OneCurrency') {
            return $result;
        } else {
            throw Exception('Неверный ключ');
        }

        
    }
}
