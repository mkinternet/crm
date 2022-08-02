<?php namespace Mkinternet\Loans\Models;

use Model;

/**
 * Model
 */
class Loan extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_loans_';

	protected $fillable = ['loanid','borrower',
		'loan_value','loan_commision','loan_percentage','loan_payedamount','loan_grantdate','loan_payeddate', 'loan_currency',
		'platform', 'loan_extracharge'];	

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
	
    public function scopePayedFilter($query, $val)
    {
		if($val==2){
			return $query->whereNotNull('loan_payeddate');
		}

		if($val==1){
			return $query->whereNull('loan_payeddate');
		}
		

    }		
}
