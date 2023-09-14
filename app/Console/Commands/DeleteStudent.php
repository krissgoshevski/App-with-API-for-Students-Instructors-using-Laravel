<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleting a random student';

    /**
     * Execute the console command.
     */

     // what this command should do is written in the handle method
  
    public function handle()
    {
        //
        $students = User::where('role_id', 2)->pluck('id'); // pluck go vraka samo id-to
        User::destroy($students[rand(0, count($students) -1)]); // ke izbrise random student 
        die();
    }
}
