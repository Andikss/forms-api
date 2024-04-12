<?php

namespace App\Http\Services\Helper;

use App\Models\Main\AllowedDomain;
use App\Models\Main\Form;
use Illuminate\Support\Facades\Auth;

/**
 * Services for handling helpers method.
 * 
 * @author Andika Dwi Saputra || @Andikss
 * @created 11 May 2024
 */

class Helper implements HelperInterface
{
    public static function isDomainAllowed(Form $form): bool
    {
        $userEmail       = Auth::user()->email;
        $userEmailDomain = explode('@', $userEmail)[1];

        return AllowedDomain::where('form_id', $form->id)
            ->where('domain', $userEmailDomain)
            ->exists();
    }
}
