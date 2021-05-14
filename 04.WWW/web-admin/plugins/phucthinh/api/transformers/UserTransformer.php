<?php

namespace PhucThinh\API\Transformers;

use Carbon\Carbon;
use League\Fractal;
use RainLab\User\Models\User As UserModel;
use Mtech\Sampling\Models\Locations;

class UserTransformer extends Fractal\TransformerAbstract {

    public function transform(UserModel $user) {
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'username' => (string) $user->last_name,
            'email' => (string) $user->email,            
            'factory_id' => $user->factory_id,
            'group' => $user->groups,
            'last_login' => Carbon::parse($user->last_login)->format('Y-m-d H:i:s'),
            'createdAt' => Carbon::parse($user->created_at)->format('Y-m-d'),
            'updatedAt' => Carbon::parse($user->updated_at)->format('Y-m-d'),
        ];
    }

}
