<?php

namespace App\Imports;

use App\Models\batch;

// use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BatchImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }


    private $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }

    public function collection(Collection $rows)
    {

        $data = batch::where('batch', '=', $this->batch)->first();

        // dd($data->count());
        if ($data) {
            dd("Data Exists For same Sheet");
        } else {
            
            $getlastindex = batch::select('id')->orderBy('id', 'desc')->first();
            // dd($getlastindex);
            if($getlastindex){
                $last_index = $getlastindex->id + 1;
            }
            else{
                $last_index = 1;
            }
            foreach ($rows as $k => $row) {
                batch::create([
                    'id' => $k + $last_index,
                    'batch' => $this->batch,
                    'address' => $row[1],
                ]);
            }
        }
    }
}