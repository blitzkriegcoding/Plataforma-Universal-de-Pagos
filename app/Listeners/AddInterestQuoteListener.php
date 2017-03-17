<?php

namespace App\Listeners;

use App\Events\AddInterestQuoteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\InteresCuota;
class AddInterestQuoteListener
{

    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(AddInterestQuoteEvent $event)
    {
        InteresCuota::create(['id_interes_mensual' => 4, 'id_interes_diario' => 4, 'id_cuota' => $event->id_quote]);
    }
}
