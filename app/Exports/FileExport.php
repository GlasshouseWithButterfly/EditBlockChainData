<?php

namespace App\Exports;

use App\Models\demotable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class FileExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd(User::all());
        $finaldata = [];
        $data = demotable::select("Txhash","Blockno","UnixTimestamp","DateTime","From_Address","To_Address","ContractAddress","Value_IN(BNB)","Value_OUT(BNB)","TokenAmount","TxnFee(BNB)","TokenName","TokenSymbol","TokenID","Method","Status")->get();

        $finaldata = collect($data);
        return $finaldata;
    }
    

    public function headings() :array
    {
        return ["Txhash","Blockno","UnixTimestamp","DateTime","From","To","ContractAddress","Value_IN(BNB)","Value_OUT(BNB)","TokenAmount","TxnFee(BNB)","TokenName","TokenSymbol","TokenID","Method","Status"];
    }

}