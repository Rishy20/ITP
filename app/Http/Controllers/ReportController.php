<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index() {
        return view('reports.index');
    }

    public function generateReport() {
        return view('reports.sales.product-wise-sales');
    }
}
