<?php

namespace App\Imports;

use App\insurance;
use Maatwebsite\Excel\Concerns\ToModel;

class InsuranceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       if(!empty($row[1])){
        return new insurance([
      
            'policy'=>$row[0],
            'location'=>$row[1],
            'region'=>$row[2],
            'insuredvalue'=>$row[3],
            'businesstype'=>$row[4],
        ]);
       }
    }
}
