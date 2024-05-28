<?php

namespace App\Support\Address\Utils;

abstract class AbstructCountryGovernorateCity {
    public $id, $name_ar, $name_en;
    public function id() : string
    {
        return $this->id;
    }
    public function name_en() : string
    {
        return $this->name_en;
    }
    public function name_ar() : string
    {
        return $this->name_ar;
    }
    public function name(string $lang = "en") : string
    {
        if($lang === "ar")
        {
            return $this->name_ar;
        }
        return $this->name_en;
    }
    
}