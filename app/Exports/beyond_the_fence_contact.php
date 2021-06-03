<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class beyond_the_fence_contact implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['Company Name','Project Title','Project Timeframe:Start date','Project Timeframe:End date','Project Area',' District','State','Geographical coordinates:Latitude','Geographical coordinates:Longitude','Contact Person:','Designation:','Mobile','Email','Correspondence Address','City','Pin code','Annual Turnover of the company (Corporate) '];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qbtf_contact_details')->select('company_name','project_title','project_start_date','project_end_date','project_area','project_district','project_state','latitude','longitude','contact_person','designation','mobile','email','correspondence_address','city','pincode','annual_turnover')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Benyod_Contact';
    }
}
