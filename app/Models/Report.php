<?php
namespace App\Models;

use App\Models\Event\Event;
use App\Models\People\Customer;
use App\Models\Ticket\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class Report extends Model
{
    public function monthlyReport(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m'));
        $startOfMonth = Carbon::parse($selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::parse($selectedMonth)->endOfMonth();

        // Fetch relevant data
        $events = Event::whereBetween('date', [$startOfMonth, $endOfMonth])->get();

        $tickets = Ticket::whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        })->get();

        $customers = Customer::whereHas('tickets', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
            });
        })->get();

        // Calculate the total sum of ticket prices
        $totalPrice = $tickets->sum(function ($ticket) {
            return $ticket->event->price; // Assuming event has a 'price' column
        });

        return view('admin.reports.index', [
            'customers' => $customers,
            'tickets' => $tickets,
            'events' => $events,
            'total' => $totalPrice,
        ]);
    }
    public function downloadReport(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m'));
        $startOfMonth = Carbon::parse($selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::parse($selectedMonth)->endOfMonth();

        // Fetch relevant data for the given month
        $events = Event::with('tickets')->whereBetween('date', [$startOfMonth, $endOfMonth])->get();

        $tickets = Ticket::whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        })->get();

        $newCustomers = Customer::whereHas('tickets', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
            });
        })->count();

        // Calculate the total sum of ticket prices
        $totalRevenue = $tickets->sum(function ($ticket) {
            return $ticket->event->price;
        });

        $data = [
            'totalEvents' => $events->count(),
            'ticketsSold' => $tickets->count(),
            'newCustomers' => $newCustomers,
            'totalRevenue' => number_format($totalRevenue, 2) . ' USD',
            'detailedReports' => $events->map(function ($event) {
                return [
                    'name' => $event->name,
                    'date' => Carbon::parse($event->date)->format('F d, Y'),
                    'tickets' => $event->tickets->count(),
                ];
            })->toArray(),
        ];

        // Generate the PDF
        $pdf = Pdf::loadView('admin.reports.pdf', $data);

        return $pdf->download('report-' . $selectedMonth . '.pdf');
    }

}

