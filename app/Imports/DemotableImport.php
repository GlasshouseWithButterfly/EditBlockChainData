<?php

namespace App\Imports;

use App\Models\demotable;
// use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DemotableImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        $data = demotable::limit(1)->orderBy('id', 'desc')->select('id', 'batch')->first();
        
        if ($data) {
            $lastId = $data->id;
            $lastBatch = $data->batch;
        }
        else{
            $lastId = 0;
            $lastBatch = 0;
        }
// dd("swdf");
        // dd(demotable::limit(1)->orderBy('id', 'desc')->select('batch')->get());
        // dd($lastId);
        foreach ($rows as $k => $row) {
            // dd($row);
            demotable::create([
                'id' => $k + $lastId + 1,
                'batch' => $lastBatch + 1,
                'Txhash' => $row[0],
                'Blockno' => $row[1],
                'UnixTimestamp' => $row[2],
                'DateTime' => $row[3],
                'From_Address' => $row[4],
                'To_Address' => $row[5],
                'ContractAddress' => $row[6],
                'Value_IN(BNB)' => $row[7],
                'Value_OUT(BNB)' => $row[8],
                'TokenAmount' => $row[9],
                'TxnFee(BNB)' => $row[10],
                'TokenName' => $row[11],
                'TokenSymbol' => $row[12],
                'TokenID' => $row[13],
                'Method' => $row[14],
                'Status' => $row[15],
                'process_flag' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
        // dd();
    }
}