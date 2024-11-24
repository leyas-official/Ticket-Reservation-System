<?php
namespace App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Payment
{
    public function getAllPayment();
    public function processPayment();
    public function processRefund();
    public function tickets();

    public function handleRequest(Request $request,$ticket);
    public function validation(Request $request);
    public static function store($request,$ticket,$amount);
    public static function checkDiscount($request,$ticket);
}
