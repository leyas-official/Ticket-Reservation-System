<?php
namespace App\Models\Payment;
use Illuminate\Database\Eloquent\Model;

interface Payment
{
    public function getAllPayment();
    public function processPayment();
    public function processRefund();
    public function tickets();

    public  function handleRequest($request,$ticket);
    public static function validation($request);
    public static function store($request,$ticket,$amount);
    public static function checkDiscount($request,$ticket);
}
