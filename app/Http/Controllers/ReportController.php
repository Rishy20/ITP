<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index() {
        return view('reports.index');
    }

    public function generateReport() {
        return view('reports.sales.by_item');
    }
}
