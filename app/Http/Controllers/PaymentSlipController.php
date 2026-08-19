<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentSlipController extends Controller
{
    public function index()
    {
        return view('payment-slip.index');
    }
}