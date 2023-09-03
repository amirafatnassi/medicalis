<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use Illuminate\View\View;

class CountryComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
       $countries = Country::orderBy('code')->get();
        $view->with('Countries', $countries);
    }
}