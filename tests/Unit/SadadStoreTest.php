<?php

namespace Tests\Unit;

use App\Models\People\Customer;
use App\Models\Ticket\Ticket;
use App\Models\Event\Event;
use App\Models\Payment\Sadad;
use App\Enums\ticketStatus;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SadadStoreTest extends TestCase
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

        // إنشاء تذكرة
        $ticket = Ticket::create([
            'userId' => $user->id,
            'eventId' => $event->id,
            'ticketStatus' => ticketStatus::ACTIVE->value,
        ]);

        // بيانات الطلب (Request)
        $request = new \Illuminate\Http\Request([
            'fullName' => $user->name,
            'phoneNumber' => $user->phone,
            'cardExpiration' => now()->addMonth()->toDateString(),
            'discountType' => 'students',
        ]);

        // استدعاء الفنكشن
        $sadad = new Sadad();
        $amount = $event->price;
        $payment = $sadad::store($request, $ticket, $amount);

        // التحقق من تحديث حالة التذكرة
        $this->assertEquals(ticketStatus::USED , $ticket->fresh()->ticketStatus);



        $this->assertDatabaseHas('payments', [
            'name' => $user->name,
            'amount' => $amount,
            'paymentType' => 'Sdad',
            'ticketId' => $ticket->id,
        ]);
    }
}
