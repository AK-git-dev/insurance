<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class Innovative_Declaration implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['Company Name','Name','Designation','Signature','Company seal','Designation','Date'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qip_declaration')->select('company_name','name','designation','signature','company_seal','date')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Innovative_contact';
    }
}
