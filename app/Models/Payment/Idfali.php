<?php


namespace App\Models\Payment;
use App\Enums\paymentStatus;
use App\Enums\ticketStatus;
use App\Models\Discount\DiscountMilitary;
use App\Models\Discount\DiscountSeniors;
use App\Models\Discount\DiscountStudent;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules\Enum;

class Idfali extends Model implements Payment
{
    protected $table = 'payments';
    protected $fillable = [
        'name',
        'paymentType',
        'amount',
        'paymentDate',
        'ticketId',
        'status',
    ];

    //fake methods
    public function processPayment()
    {
        return True;
    }

    public function processRefund()
    {
        return True;
    }

    public function getAllPayment()
    {
        // TODO: Implement getAllPayment() method.
    }




    //main method responsible for storing payments into database
    public function handleRequest($request,$ticket)
    {
        $discountType = $request->discountType;
        $amount = self::checkDiscount($discountType , $ticket);

        try {
            if(self::processPayment()){
                self::store($request,$ticket,$amount);
                return true;
            } else {
                return false;
            }
        }  catch (\Exception $e){
            dd($e->getMessage());
        }
    }


    // validates data and returns it to form page if data is invalid
    public function validation($request)
    {
        $validator = \Validator::make($request->all(), [
            'cardNumber' => 'required|numeric',
            'nationalId' => 'required|numeric|starts_with:1,2|digits:10',
            'discountType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return $validator->validated(); // Return validated data if successful
    }


    // this creates and saves an instance of payment into the database
    // also it updates the ticket status from INACTIVE to ACTIVE after successful purchase
    public static function store($request,$ticket,$amount)
    {
        try {
            $row = self::create([
                'name' => $ticket->user->name,
                'amount' => $amount,
                'paymentDate' => now(),
                'paymentType' => 'Idfali',
                'status' => paymentStatus::PAID,
            ]);

            $ticket->update([
                'ticketStatus' => ticketStatus::ACTIVE,
                'payment_id' => $row->id,
            ]);

        }catch (\Illuminate\Database\QueryException $e) {
            // This will catch database-related exceptions
            dd(response()->json([
                'error' => 'Database error occurred.',
                'message' => $e->getMessage(),
            ], 500)) ; // Return a 500 Internal Server Error with the message
        } catch (\Exception $e) {
            // This will catch other general exceptions
            dd(response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage(),
            ], 500));
        }
    }


    // this checks what type of discount the user chosen in the form
    // it creates an instance of discount based on the users discount type dynamically
    public static function checkDiscount($discountType,$ticket)
    {
        $discountHandlers = [
            'seniors' => DiscountSeniors::class,
            'students' => DiscountStudent::class,
            'military' => DiscountMilitary::class,
        ];

        if (isset($discountHandlers[$discountType])) {
            $handler = new $discountHandlers[$discountType];
            return $handler->makeDiscount($ticket->event->price);
        }

        return $ticket->event->price;
    }


    //responsible for changing payment records status to REFUNDED
    public function updateToRefunded($ticket): void
    {
        $ticket->payment->status = paymentStatus::REFUNDED;
        $ticket->payment->save();

        // the ticket gets deleted from the database here
        // it is not worth it to call an entire method just for one line of code
        $ticket->delete();
    }


    // database relationship
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
