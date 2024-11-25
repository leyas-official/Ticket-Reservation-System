<?php

namespace Tests\Unit;

use App\Enums\paymentStatus;
use App\Models\Payment\Idfali;
use App\Models\Payment\MobiCash;
use App\Models\People\Customer;
use App\Models\Ticket\Reservation;
use App\Models\Ticket\Ticket;
use App\Models\Event\Event;
use App\Models\Payment\Sadad;
use App\Enums\ticketStatus;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RefundMobiCashTest extends TestCase
{
    use DatabaseTransactions;

    public function test_hundleRefundProcedures_method_updates_ticket_and_creates_payment()
    {
        // test 1
        // إنشاء مستخدم
        $user = Customer::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'Role' => 'U',
        ]);

        // إنشاء حدث
        $event = Event::create([
            'name' => 'Test Event',
            'price' => 100,
            'time' => now()->addDays(10)->format('H:i:s'),
            'description' => 'This is a test event description.',
            'date' => now()->addDays(10)->toDateString(),
            'locationId' => 1,
            'numberOfTicket' => 30,
            'type' => 'sport',
        ]);

        $paymentData = [
            'name' => $user->name,
            'amount' => $event->price,
            'paymentDate' => now(),
            'paymentType' => 'MobiCash',
            'status' => paymentStatus::PENDING->value,
        ];

        $paymentId = DB::table('payments')->insertGetId($paymentData);

        // Retrieve the inserted payment using the ID
        $payment = DB::table('payments')->find($paymentId);

        $ticket = Ticket::create([
            'userId' => $user->id,
            'eventId' => $event->id,
            'ticketStatus' => ticketStatus::ACTIVE->value,
            'payment_id' => $payment->id,
        ]);

        $model = new Reservation();
        $amount = $event->price;
        $model->hundleRefundProcedures($ticket);

        $payment = DB::table('payments')->find($paymentId);

        $this->assertEquals(paymentStatus::REFUNDED->value, $payment->status);

        $this->assertDatabaseHas('payments', [
            'name' => $user->name,
            'amount' => $amount,
            'paymentType' => 'MobiCash',
            'paymentDate' => now()->format('Y-m-d H:i:s'),
            'status' => paymentStatus::REFUNDED->value,
        ]);

        // إنشاء حدث
        $event = Event::create([
            'name' => 'Test Event',
            'price' => 100,
            'time' => now()->addDays(10)->format('H:i:s'),
            'description' => 'This is a test event description.',
            'date' => now()->addDays(10)->toDateString(),
            'locationId' => 1,
            'numberOfTicket' => 30,
            'type' => 'movie',
        ]);

        $paymentData = [
            'name' => $user->name,
            'amount' => $event->price,
            'paymentDate' => now(),
            'paymentType' => 'unknown',
            'status' => paymentStatus::PAID->value,
        ];

        $paymentId = DB::table('payments')->insertGetId($paymentData);

        // Retrieve the inserted payment using the ID
        $payment = DB::table('payments')->find($paymentId);

        $ticket = Ticket::create([
            'userId' => $user->id,
            'eventId' => $event->id,
            'ticketStatus' => ticketStatus::ACTIVE->value,
            'payment_id' => $payment->id,
        ]);

        $model = new Reservation();
        $result = $model->hundleRefundProcedures($ticket);

        // Assert that a redirect occurred to the correct route
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $result);
        $this->assertEquals(route('myCart'), $result->getTargetUrl());

        $this->assertEquals('Error occurred during the refund process, Please try again.', session('error'));

        $this->assertDatabaseHas('payments', [
            'name' => $user->name,
            'amount' => $amount,
            'paymentType' => 'unknown',
            'paymentDate' => now()->format('Y-m-d H:i:s'),
            'status' => paymentStatus::PAID->value,
        ]);
    }
}


