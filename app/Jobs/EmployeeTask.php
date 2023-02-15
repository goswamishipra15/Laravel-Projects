<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Employee;
use App\Http\Controllers\EmployeeController;

use DB;

class EmployeeTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Log::info('Job is working');
        $users = DB::select('select * from employee');
        foreach($users as $user){
            Log::info($user->name);
            $result = DB::insert('INSERT INTO employee2 VALUES(?,?,?,?,?)', array($user->emp_id,$user->name,$user->email,$user->gender,$user->status));
            Log::info($result);
            if($result){
                DB::delete('delete from employee where (?)',array($user->emp_id));
            }

        }
        Log::info('Making directory2');
}
}
