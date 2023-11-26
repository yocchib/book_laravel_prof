<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sample-command'; // コマンドの名前 (p206 taka)

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sample Command'; // コマンドの説明文 (p206 taka)

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // コマンドの実処理を書く (p206 taka)
        echo 'このコマンドはサンプルです';
        return 0;
    }
}
