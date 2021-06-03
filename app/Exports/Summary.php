<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;

class Summary implements FromCollection,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['Summary'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qwtf_summary')->select('summary')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Summary';
    }
}
