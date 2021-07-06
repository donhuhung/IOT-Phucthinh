<?php

namespace PhucThinh\API\Transformers;

use Carbon\Carbon;
use League\Fractal;
use PhucThinh\IOT\Models\Factory;

class FactoryTransformer extends Fractal\TransformerAbstract {

    public function transform(Factory $factory) {      
        return [
            'id' => (int) $factory->id,
			'factory_id' => (int) $factory->factory_id,
            'name' => (string) $factory->name,
            'ip' => (string) $factory->ip,            
            'langtitude' => $factory->langtitude,
            'longtitude' => $factory->longtitude,  
			'address' => (string) $factory->address,			
            'thumbnail' => $factory->thumbnail?$factory->thumbnail->getPath():'',            
            'overview' => $factory->overview?$factory->overview->getPath():'',            
        ];
    }

}
