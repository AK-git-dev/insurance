<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Sheets implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 use Exportable;
	  public function __construct(int $id)
    {
        $this->userid = $id;
    }
	 
   public function sheets(): array
    {
        $sheets = [];

        
            $sheets[0] = new questionExport($this->userid);
			 $sheets[1] = new Summary($this->userid);

        return $sheets;
    }
}
