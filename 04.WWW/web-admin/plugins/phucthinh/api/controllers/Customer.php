<?php namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;
use PhucThinh\IOT\Models\Customer As CustomerModel;
use PhucThinh\API\Transformers\CustomerTransformer;

/**
 * Customer Back-end Controller
 */
class Customer extends General
{
    protected $customerRepository;

    public function __construct(CustomerModel $customer) {
        $this->customerRepository = $customer;
    }
    
    //API Get List Customer
    public function getList(Request $request) {
        try {
            $customers = CustomerModel::where('status', 1)->get();
            $results = fractal($customers, new CustomerTransformer())->toArray();
            return $this->respondWithSuccess($results, "Get List Customer succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }
}
