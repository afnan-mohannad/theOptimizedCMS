<?php

namespace App\Jobs;

use Exception;
use App\Imports\UsersImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\QueryException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UsersImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uploadFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            Excel::import(new UsersImport, $this->uploadFile);
        }catch(Exception $e){
            Log::error($e->getMessage());
        }catch(QueryException $ex){ 
            Log::error($ex->getMessage()); 
        }
    }
}