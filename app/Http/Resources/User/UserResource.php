<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use JsonSerializable;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_roles_id' => (string) $this->user_roles_id,
            'user_role_name' => isset($this->role->name) ? $this->role->name : '',
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'photo_url' => ! empty($this->photo) ? Storage::disk('public')->url($this->photo) : Storage::disk('public')->url('../assets/img/no-image.png'),
            'updated_security' => $this->updated_security,
            'access' => isset($this->role->access) ? json_decode($this->role->access) : [],
        ];
    }
}
