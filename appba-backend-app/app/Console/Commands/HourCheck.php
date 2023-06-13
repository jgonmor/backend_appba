<?php

namespace App\Console\Commands;

use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HourCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hour-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check 48h from request';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $requests = Solicitud::whereRaw("estado != 'ACEPTADA' && estado != 'RECHAZADA'")->get();
        $now = Carbon::now();
        
        foreach($requests as $request){
            $hours = $now->diffInHours($request->fecha_hora);
            if($hours > 48){
                Solicitud::where("id", $request->id)->update(["estado" => "ACEPTADA"]);

            }
        }

        $this->info($requests);
    }
}
