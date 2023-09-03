<?php

namespace App\Http\View\Composers;

use App\Models\Radiotype;
use Illuminate\View\View;

class RadioTypeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('RadioTypes', RadioType::all());
    }
}