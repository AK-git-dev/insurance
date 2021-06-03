<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class beyond_the_fence_summary implements  FromCollection ,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
	 public function __construct(int $id)
    {
        $this->id = $id;
        
    }
    public function headings(): array {
        
        $fieldvalues=['Short description and objective of the project','Reasons for undertaking the project ','Achievements under the project ','Did you undertake any scientific study prior to undertaking the project? If yes, share as annexure','Did you undertake any scientific study prior to undertaking the project? If yes, share as annexure','How was the project executed','Describe the key activities under the project','Who is the target group/project beneficiaries','. Elucidate the role of the community in the project cycle. Please mention how community was involved in conceptualizing / planning / implementing / maintaining etc.','Did the project incorporate gender sensitive design? If yes, how','Did the project incorporate gender sensitive design? If yes, how','What has been the project funding mechanism','Did the project involve dovetailing with any ongoing Government scheme/project?','Mention the monitoring mechanism (institutional structure / instruments/ data system for collection, analysis and tracking progress) to ensure effective implementation of the project and measurement of benefits of the project','Explain measures taken to ensure sustainability (social, economic, environmental) of the project Also detail out measures in place (in case of project handover to the community) and brief about exit strategy ','Have you conducted third party assessment of the project? If yes, highlight the important findings','Have you conducted third party assessment of the project? If yes, highlight the important findings','Have you conducted third party assessment of the project? If yes, highlight the important findings and share file','Any outreach/awareness generation material prepared? Any certificates of recognition and appreciation. Please include the same','Any outreach/awareness generation material prepared? Any certificates of recognition and appreciation. Please include the same','Lessons learnt for scalability and replicability'];
       
      
        return $fieldvalues;
      }
    public function collection()
    {
        //
		$data=DB::table('qbtf_questions')->select('question_1','question_2','question_3','question_4','question_4_file','question_5','question_6','question_8','question_9','question_10','question_10_description','question_12','question_13','question_14','question_15','question_16','question_16_highlight','question_16_file','question_17','question_17_file','question_18')->where('user_id', $this->id)->get();
		return $data;
		
    }
	
	 public function title(): string
    {
        return 'Benyod_summary';
    }
}
