<?php

use Illuminate\Support\Facades\Auth;

function lms_unauthorized($permission) {
    // dd($permission);
    if(!Auth::user()->hasPermissionTo($permission)) {
        flash()->addWarning('You are not authorized to this page');
        return redirect()->back();
    }
}
