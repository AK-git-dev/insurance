<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class beyond_the_fence_declaration implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['organization_name','Name','designation','signature','company_seal','date'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qbtf_declaration')->select('organization_name','Name','designation','signature','company_seal','date')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Benyod_declaration';
    }
}
