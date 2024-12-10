<?php
namespace App\Models\Report;

use App\Models\Event\Event;
use App\Models\People\Customer;
use App\Models\Ticket\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class Report
{
    // Property to store the singleton instance
    private static ?Report $instance = null;

    private function __construct()
    {
    }

    // Method to retrieve the singleton instance
    public static function getInstance(): Report
    {
        if (self::$instance === null) {
            self::$instance = new Report();
        }

        return self::$instance;
    }


    // Monthly Report Method
    public function monthlyReport()
    {
        try {
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();

            // Fetching data
            $events = new Event();
            $events = $events->getEventsForMonth($startOfMonth, $endOfMonth);

            $tickets = new Ticket();
            $tickets = $tickets->getTicketsForMonth($startOfMonth, $endOfMonth);

            $customer = new Customer();
            $customers = $customer->getCustomersForMonth($startOfMonth, $endOfMonth);

            $totalRevenue = new Ticket();
            $totalRevenue =  $totalRevenue->calculateTotalTicketPrice($tickets);

            // Returning the report view
            return view('admin.reports.index', [
                'events' => $events,
                'tickets' => $tickets,
                'customers' => $customers,
                'total' => $totalRevenue,
            ]);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    // Download Report Method
    public function downloadReport()
    {
        try {

        $month = now()->format('Y-m');
        $startOfMonth = Carbon::parse($month)->startOfMonth();
        $endOfMonth = Carbon::parse($month)->endOfMonth();

        // Fetching data
        $events = new Event();
        $events = $events->getEventsForMonth($startOfMonth, $endOfMonth);

        $tickets = new Ticket();
        $tickets = $tickets->getTicketsForMonth($startOfMonth, $endOfMonth);

        $customer = new Customer();
        $customers = $customer->getCustomersForMonth($startOfMonth, $endOfMonth);

        $totalRevenue = new Ticket();
        $totalRevenue =  $totalRevenue->calculateTotalTicketPrice($tickets);


        // Preparing data for PDF
        $data = [
            'totalEvents' => $events->count(),
            'ticketsSold' => $tickets->count(),
            'newCustomers' => $customers->count(),
            'totalRevenue' => number_format($totalRevenue, 2) . ' USD',
            'detailedReports' => $events->map(function ($event) {
                return [
                    'name' => $event->name,
                    'date' => Carbon::parse($event->date)->format('F d, Y'),
                    'tickets' => $event->tickets->count(),
                ];
            })->toArray(),
        ];

        // Generating the PDF
        $pdf = Pdf::loadView('admin.reports.pdf', $data);

        return $pdf->download('report-' . $month . '.pdf');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
}

