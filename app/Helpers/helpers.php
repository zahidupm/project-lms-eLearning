<?php

use Illuminate\Support\Facades\Auth;

function permission_check($permission) {
    // dd($permission);
    if(!Auth::user()->hasPermissionTo($permission)) {
        flash()->addWarning('You are not authorized to this page');
        return redirect()->back();
    }
}
