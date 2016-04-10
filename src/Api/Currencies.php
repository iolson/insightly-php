<?php

namespace IanOlson\Insightly\Api;

class Currencies extends Api
{
    /**
     * Gets a list of currencies used by Insightly.
     *
     * @return array
     */
    public function all()
    {
        return $this->getRequest("Currencies");
    }
}
