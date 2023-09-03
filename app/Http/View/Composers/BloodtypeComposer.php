<?php

namespace App\Http\View\Composers;

use App\Models\Bloodtype;
use Illuminate\View\View;

class BloodtypeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Bloodtypes', Bloodtype::orderBy('id')->paginate());
    }
}