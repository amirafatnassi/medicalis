<?php

namespace App\Http\View\Composers;

use App\Models\Profession;
use Illuminate\View\View;

class ProfessionComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Professions', Profession::all());
    }
}