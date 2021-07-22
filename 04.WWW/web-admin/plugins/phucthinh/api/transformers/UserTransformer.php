<?php

namespace PhucThinh\API\Transformers;

use Carbon\Carbon;
use League\Fractal;
use RainLab\User\Models\User As UserModel;
use PhucThinh\IOT\Models\Customer;

class UserTransformer extends Fractal\TransformerAbstract {

    public function transform(UserModel $user) {
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'username' => (string) $user->last_name,
            'email' => (string) $user->email,
            'customer' => $this->getCustomerByUser($user->customer_id),
            'phone' => $user->phone,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'gender' => $user->gender,
            'group' => $user->groups,
            'last_login' => Carbon::parse($user->last_login)->format('Y-m-d H:i:s'),
            'createdAt' => Carbon::parse($user->created_at)->format('Y-m-d'),
            'updatedAt' => Carbon::parse($user->updated_at)->format('Y-m-d'),
        ];
    }

    public function getCustomerByUser($customerID) {
        $customer = Customer::find($customerID);
        $dataCustomer = [];
        $dataCustomer['id'] = $customer->id;
        $dataCustomer['name'] = $customer->name;
        $dataCustomer['logo'] = $customer->logo ? $customer->logo->getPath() : '';
        return $dataCustomer;
    }

}
