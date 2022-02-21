<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
    
        return new User([
            'name'     => $row[0],
            'email'    => $row[1],
            
        ]);
    }
}