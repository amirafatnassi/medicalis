<?php

namespace App\Http\View\Composers;

use App\DossierUser;
use Illuminate\View\View;

class AccesComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('acces', DossierUser::all());
    }
}