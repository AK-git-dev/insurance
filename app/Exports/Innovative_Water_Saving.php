<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class Innovative_Water_Saving implements WithMultipleSheets
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
        //
		 $sheets = [];

        
            $sheets[0] = new Innovative_contact($this->userid);
			 $sheets[1] = new Innovative_Declaration($this->userid);
			  $sheets[2] = new Innovative_Brief_Description($this->userid);

        return $sheets;
    }
}
