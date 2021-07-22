<?php

namespace PhucThinh\API\Transformers;

use League\Fractal;
use PhucThinh\IOT\Models\Customer;

class CustomerTransformer extends Fractal\TransformerAbstract {

    public function transform(Customer $customer) {
        return [
            'id' => (int) $customer->id,
            'name' => (string) $customer->name,            
            'logo' => $customer->logo ? $customer->logo->getPath() : '',            
        ];
    }

}
