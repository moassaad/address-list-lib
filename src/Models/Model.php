<?php

namespace Moassaad\Addressia\Models;

use Moassaad\Addressia\Enums\Language\LanguageFlag;

abstract class Model
{
    protected $id, $name_ar, $name_en;
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
    public function name(string $lang = LanguageFlag::EN->value) : string
    {
        if($lang === LanguageFlag::AR->value)
        {
            return $this->name_ar;
        }
        return $this->name_en;
    }
    protected function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
    protected function setNameEn(string $name)
    {
        $this->name_en = $name;
        return $this;
    }
    protected function setNameAr(string $name)
    {
        $this->name_ar = $name;
        return $this;
    }
}
