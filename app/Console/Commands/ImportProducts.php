<?php

namespace App\Console\Commands;

use App\Services\SpreadsheetService;
use Illuminate\Console\Command;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SpreadsheetService $service)
    {
        $this->info('Importing...');
        $service->processSpreadsheet('fake/path/to/spreadsheet.csv');
        $this->info('Done.');
    }
}
