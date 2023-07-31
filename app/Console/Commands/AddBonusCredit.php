<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddBonusCredit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-bonus-credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add 5 bonus credit on 1st of each month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('email', '!=', 'admin@xinva.ai')->increment('total_credits', 5);
    }
}
