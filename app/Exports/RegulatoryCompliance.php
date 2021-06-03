<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;
class RegulatoryCompliance implements FromCollection,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        
        $fieldvalues=['Does the plant have a valid consent to operate?','Valid Till','Share Valid Consent to Operate with conditions or the application letter for renewal','If the source of water is surface water, then does the plant have a valid MoU/agreement from Irrigation Department/MoWR?','Valid till','Permitted Quantity (n m3/day) till','Share the MoU/agreement with details of the permitted quantity of water consumption','If the source of water is groundwater, then does the plant have a valid NOC from CGWA?','Valid till','Share the NoC with the prescribed conditions.','Has the Environmental Compliance Report of Stipulated Conditions of Environmental Clearance submitted to MoEFCC?','Share latest report submitted.','Has a hydrogeological study been conducted in last two years?','Share some of the key outcomes of the hydrogeological study.'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qwtf_regulatory_compliance')->select('summary')->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'RegulatoryCompliance';
    }
}
