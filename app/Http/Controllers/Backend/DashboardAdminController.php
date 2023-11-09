<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }
}
