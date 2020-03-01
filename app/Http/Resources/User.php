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
        //dd($this);

        return [
            'fullName' => $this->fullName,
            'email_phone' => $this->email_phone,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'role' => $this->role,
            'updated_at' => $this->updated_at,
        ];
    }
}
