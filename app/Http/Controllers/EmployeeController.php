<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Jobs\EmployeeTask;
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    public function index(){
        $users = DB::select('select * from employee');
        Log::info('Controller is working');
        //foreach($users as $user){
        //echo "<pre>";
        //DB::insert('INSERT INTO employee2 VALUES(?,?,?,?,?)', array($user->emp_id,$user->name,$user->email,$user->gender,$user->status));
        //print_r($user->emp_id);
        EmployeeTask::dispatch($users);
    }
}
