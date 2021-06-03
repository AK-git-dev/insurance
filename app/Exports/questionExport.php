<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class questionExport implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	
	  public function __construct(int $id)
    {
        $this->id = $id;
        
    }
	
	public function headings(): array {
        
        $fieldvalues=['Company Name','Contact Person','Designation','Mobile','Email','Full Address','City','Pin code','Latitude','Longitude','Annual Turnover of the company','Product Capacity','Industrial Sector','Classification of Industrial Sector as per CPCB(Red/Orange/Green/White)','Categorization of assessment unit as per Stage of Groundwater Development (Safe/Semi-critical/Critical/Overexploited) as per CGWA','List your major products along with brief manufacturing process'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qwtf_contact_details')->select('company_name','contact_person','designation','mobile','email','address','city','pincode','plant_location_lat','plant_location_longitude','annual_turnover','product_capacity','industrial_sector','c_o_i_s_a_p_cpcb','c_o_a_u_a_p_s_o_g_d_a_p_cgwa','major_product_description')
		->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Contact ';
    }
	
		
	
	
}
