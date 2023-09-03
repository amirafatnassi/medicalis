<?php

namespace App\Http\View\Composers;

use App\Models\Role;
use Illuminate\View\View;

class RoleComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('Roles', Role::all());
    }
}