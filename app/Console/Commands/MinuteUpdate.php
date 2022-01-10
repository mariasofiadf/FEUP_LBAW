<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Models\User;
use App\Http\Controllers\AuctionController;


class MinuteUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        AuctionController::checkAuctionEnd();
        return Command::SUCCESS;
    }
}
