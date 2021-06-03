<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class Innovative_Brief_Description implements FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['Technical Details of innovative product','Is the product leading to:Improvement in Water Quality','Is the product leading to:Improvement in Water Savings','Year of development','Principle of operation / Technology of the product. Explain the chemistry behind the technology, if applicable',
		  'What is the cost of technology? (Indicate both capex and opex cost in relation to the capacity of water/wastewater that the technology/product handles (in Rs./m3))','why it is innovative in comparison to similar products available in the market','Impact of the product on water management including cost economics','Replication potential in the Indian Market.','Any demo video of the product is available? (If Yes, provide link)','Any demo video of the product is available? (If Yes, provide link)','Does the company own patent for the product. (If yes, kindly share)','Does the company own patent for the product. (If yes, kindly share)'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qip_brief_description')->select('technical_details','leading_product','improvement_in_water_quality','improvement_in_water_saving','development_year','h_t_t_b_u_f_2_o_m_y','principle_of_technology','cost_of_technology','h_w_i_i_i_i_c_t_s_p_a_i_t_m','i_o_t_p_o_w_m_i_c_e','r_p_i_t_i_m','a_d_v_o_t_p_i_a','a_d_v_o_t_p_i_a_link','d_t_c_o_p_f_t_p','d_t_c_o_p_f_t_p_file')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Innovative_Brief_Description';
    }
}
