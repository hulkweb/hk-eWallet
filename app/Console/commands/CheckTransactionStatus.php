<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Console\Command;

class CheckTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will update transactions status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transaction = new TransactionController();
        $transaction->CheckTransactionStatus();

        return Command::SUCCESS;
    }
}
