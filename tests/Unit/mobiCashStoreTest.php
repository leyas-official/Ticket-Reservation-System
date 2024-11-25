<?php

namespace Tests\Unit;

use App\Enums\paymentStatus;
use App\Models\Payment\MobiCash;
use App\Models\People\Customer;
use App\Models\Ticket\Ticket;
use App\Models\Event\Event;
use App\Enums\ticketStatus;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class mobiCashStoreTest extends TestCase
{
    use DatabaseTransactions;

    public function test_store_method_updates_ticket_and_creates_payment()
    {
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

        $ticket = Ticket::create([
            'userId' => $user->id,
            'eventId' => $event->id,
            'ticketStatus' => ticketStatus::INACTIVE->value,
        ]);

        // بيانات الطلب (Request)
        $request = new \Illuminate\Http\Request([
            'fullName' => $user->name,
            'phoneNumber' => $user->phone,
            'cardExpiration' => now()->addMonth()->toDateString(),
            'discountType' => 'students',
        ]);

        $mobiCash = new MobiCash();
        $amount = $event->price;


        $payment = $mobiCash::store($request, $ticket, $amount);


        $this->assertEquals(ticketStatus::ACTIVE, $ticket->fresh()->ticketStatus);

        $this->assertDatabaseHas('payments', [
            'name' => $user->name,
            'amount' => $amount,
            'paymentType' => 'MobiCash',
            'paymentDate' => now()->format('Y-m-d H:i:s'),
            'status' => paymentStatus::PAID,
        ]);

    }
}
