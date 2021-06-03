<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Sheets_beyond_the_fence implements WithMultipleSheets
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

        
            $sheets[0] = new beyond_the_fence_contact($this->userid);
			 $sheets[1] = new beyond_the_fence_summary($this->userid);
			  $sheets[2] = new beyond_the_fence_declaration($this->userid);

        return $sheets;
    }
}
