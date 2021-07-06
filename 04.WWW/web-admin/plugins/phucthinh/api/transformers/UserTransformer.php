<?php

namespace PhucThinh\API\Transformers;

use Carbon\Carbon;
use League\Fractal;
use RainLab\User\Models\User As UserModel;
use PhucThinh\IOT\Models\Factory;

class UserTransformer extends Fractal\TransformerAbstract {

    public function transform(UserModel $user) {
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'username' => (string) $user->last_name,
            'email' => (string) $user->email,                        
            'factory' => $this->getFactoryByUser($user->factory_id),
			'phone' => $user->phone,
			'address' => $user->address,
			'birthday' => $user->birthday,
            'group' => $user->groups,
            'last_login' => Carbon::parse($user->last_login)->format('Y-m-d H:i:s'),
            'createdAt' => Carbon::parse($user->created_at)->format('Y-m-d'),
            'updatedAt' => Carbon::parse($user->updated_at)->format('Y-m-d'),
        ];
    }
    
    public function getFactoryByUser($factoryID){
        $factory = Factory::find($factoryID);
        $dataFactory = [];
        $dataFactory['id'] = $factory->id;
        $dataFactory['name'] = $factory->name;
        $dataFactory['thumbnail'] = $factory->thumbnail?$factory->thumbnail->getPath():'';
        $dataFactory['overview'] = $factory->overview?$factory->overview->getPath():'';        
		$dataFactory['factory_id'] = $factory->factory_id;        
		$dataFactory['address'] = $factory->address;        
		$dataFactory['ip'] = $factory->ip;
        return $dataFactory;
    }

}
