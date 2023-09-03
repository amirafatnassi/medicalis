<?php

namespace App\Http\View\Composers;

use App\Models\Organisme;
use Illuminate\View\View;

class OrganismeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Organismes', Organisme::all());
    }
}