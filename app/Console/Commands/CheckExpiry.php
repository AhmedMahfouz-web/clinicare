<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Expiry;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CheckExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expired = Expiry::first();

        if (Hash::check('invalid', $expired->expired)) {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->update([
                    'active' => false
                ]);
            }
        }
    }
}
