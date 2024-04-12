<?php

namespace App\Http\Services\Helper;

use App\Models\Main\Form;

interface HelperInterface
{
    /**
     * Method to check if the domain is allowed for the given form
     * 
     * @param Form 
     * @return bool 
     */

    public static function isDomainAllowed(Form $form): bool;
}
