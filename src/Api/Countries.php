<?php

namespace IanOlson\Insightly\Api;

class Countries extends Api
{
    /**
     * Gets a list of countries used by Insightly.
     *
     * @return array
     */
    public function all()
    {
        return $this->getRequest("Countries");
    }
}
