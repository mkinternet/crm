<?php namespace Mkinternet\Loans\Models;


use Mkinternet\Loans\Models\Loan;

/**
 * Model
 */
class LoanImport extends \Backend\Models\ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
		
		
        foreach ($results as $row => $data) {

            try {
				
				$loanexist = Loan::where('loanid', $data['loanid'])->get();


				
					$data['loan_value'] = $data['loan_value']-$data['loan_commision'];

					$data['loan_payedamount'] = str_replace(',','.',$data['loan_payedamount']);
					$data['loan_percentage'] = str_replace('%','',$data['loan_percentage']);
					
					if($data['loan_payeddate']=='') $data['loan_payeddate'] = null;
					
					
					if($data['loan_payeddate']!=null){
						$data['loan_payedamount'] = $data['loan_payedamount'] - $data['loan_commision'];
					}
					
					if($data['loan_extracharge']=='') $data['loan_extracharge'] = null;



				
				if($loanexist->isEmpty()){



					//dd($data);
					
					$loan = new Loan;
					$loan->fill($data);
					$loan->save();
					
					$this->logCreated();
				}

                
            }
            catch (\Exception $ex) {
				

				
                $this->logError($row, $ex->getMessage());
            }

        }
    }
}
