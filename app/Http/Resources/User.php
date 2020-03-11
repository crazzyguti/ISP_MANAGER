<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'fullName' => $this->fullName,
            'email_phone' => $this->email_phone,
            'gender' => $this->gender,
            //'roles' => $this->getRoleNames(),
            'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}