<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Service\ValuteService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Fill_currency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dayT = Carbon::now();
        for ($i = 0; $i < 40; $i++) {
            $dayB = Carbon::create($dayT)->subDays($i)->format('d/m/Y');
            $dayD = Carbon::create($dayT)->subDays($i);
            echo 'День '. $i;
            echo '   ';
            $xml = ValuteService::getQuotesDay($dayB);
            foreach ($xml->Valute as $a) {
                Currency::create(
                    [
                        'valuteID' => $a->attributes()->ID,
                        'numCode' => $a->NumCode,
                        'name' => $a->Name,
                        'сharCode' => $a->CharCode,
                        'value' => $a->Value,
                        'date' => $dayD,
                    ]
                );
            }
        }
        return Command::SUCCESS;
    }
}
