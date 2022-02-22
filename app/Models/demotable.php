<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class demotable extends Model
{
    use HasFactory;
    protected $table = 'demotables';
    protected $fillable = [
        'id',
        'batch',
        'Txhash',
        'Blockno',
        'UnixTimestamp',
        'DateTime',
        'From_Address',
        'To_Address',
        'ContractAddress',
        'Value_IN(BNB)',
        'Value_OUT(BNB)',
        'TokenAmount',
        'TxnFee(BNB)',
        'TokenName',
        'TokenSymbol',
        'TokenID',
        'Method',
        'Status',
        'process_flag',
        'created_by',
        'updated_by',
    ];

    public function getBatchCount()
    {
        DB::statement("SET SQL_MODE=''");
        $dataArr = $this->select('batch', DB::raw('COUNT(batch) as c'), 'updated_at', 'process_flag')->groupBy('batch')->orderBy('updated_at', 'desc')->get();

        return $dataArr;
    }

    // get unique address finds unique values in from_address
    public function getUniqueAddress($batch)
    {
        DB::statement("SET SQL_MODE=''");
        $data = $this->whereNull('Status')->where('batch', '=', $batch)->where('From_Address', '<>', '1')->groupBy('From_Address')->select('From_Address', 'batch')->get();
        // $data2 = $this->whereNull('Status')->get();


        return $data;
    }

    public function markUniqueAddress($data, $batch)
    {
        // dd($data);

        $address_csv = [];
        foreach ($data as $value) {
            $temp = $value->From_Address;
            array_push($address_csv, $temp);
        }

        // DB::statement("SET SQL_MODE=''");
        // SELECT * FROM `demotables` WHERE To_Address IN ('0xba7f52292e16f39298344871bf4c0c7538e1a9b1', '123', '1234', '12345') 

        // second step - finds similiar data in to_address column which is sent by getUniqueAddress 

        $UniqueSimiliarAddr = demotable::whereNull('Status')->whereIn('To_Address', $address_csv)->groupBy('To_Address')->select('To_Address', 'Txhash')->get();

        // third step is get these unique address finds in from_address then in to_address and marks some identifier

        foreach ($UniqueSimiliarAddr as $key => $value) {
           
            // SELECT * FROM `demotables` WHERE From_Address = '0xba7f52292e16f39298344871bf4c0c7538e1a9b1' or To_Address= '0xba7f52292e16f39298344871bf4c0c7538e1a9b1';

            $data = $this->whereNull('Status')->where('From_Address', '=', $value->To_Address)->orWhere('To_Address', '=', $value->To_Address);

            $data->whereNull('Status')->update(['Status' => $batch . '_' . $key + 1]);

            // $data = $this->whereNull('Status')->where('From_Address', '=', $value->To_Address)->where('To_Address', '=', $value->To_Address)->where('Txhash', '=', $value->Txhash)->update(['Status' => "Swap"]);
            
        }
        // dd();
        // $this->whereNull('Status')->where('To_Address', $value->From_Address)->where('batch', '=', $batch)->update(['Status' => $batch . '_' . $key + 1]);
    }

    public function markSwapAddress($batch)
    {
        $data = $this->where('Status', 'like', $batch . '_%')->get();
        foreach ($data as $key => $value) {
            $data = $this->where('Status', '=', $value->Status)->where('Txhash', $value->Txhash);

            if ($data->get()->count() > 1) {
                $data->update(['Status' => 'Swap']);
            }
        }
    }
}