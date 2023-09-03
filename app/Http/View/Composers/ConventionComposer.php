<?php

namespace App\Http\View\Composers;

use App\Models\Convention;
use Illuminate\View\View;

class ConventionComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Conventions', Convention::orderByDesc('created_at')->paginate());
    }
}