<?php

namespace App\Console\Commands;

use App\Services\CustomerImporter;
use Illuminate\Console\Command;

class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {count=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command use to import Australian customers from RandomUser API';

    public function __construct(private CustomerImporter $importer)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        try {
            $this->info('Importing...');
            $this->importer->import((int) $this->argument('count'));
            $this->info('Import completed.');
            logger()->info('Customer import completed.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            logger()->error('Customer import failed.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
