<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class Innovative_contact implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
      public function headings(): array {
        
        $fieldvalues=['Company Name','Address for Communication','Phone','Email','Contact person','Designation','Type of products manufactured / provided','Annual Turnover of the company (corporate) (2020 – 2021)'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qip_contact_details')->select('company_name','address','mobile','email','contact_person','designation','manufactured_product_type','annual_turnover')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Innovative_contact';
    }
}
