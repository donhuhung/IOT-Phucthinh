<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;
use Hash;
use PhucThinh\IOT\Models\Factory As FactoryModel;
use PhucThinh\API\Transformers\FactoryTransformer;
use JWTAuth;

/**
 * Factory Back-end Controller
 */
class Factory extends General {

    protected $factoryRepository;

    public function __construct(FactoryModel $factory) {
        $this->factoryRepository = $factory;
    }

    public function getList(Request $request) {
        try {
            $customerID = $request->get('customer_id');
            $factories = FactoryModel::where('status', 1)->where('customer_id',$customerID)->get();
            $results = fractal($factories, new FactoryTransformer('list'))->toArray();
            return $this->respondWithSuccess($results, "Get List Factory succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }
	
	public function getDetail(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $factories = FactoryModel::find($factoryID);
            $results = fractal($factories, new FactoryTransformer('detail'))->toArray();
            return $this->respondWithSuccess($results, "Get List Factory succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

}
