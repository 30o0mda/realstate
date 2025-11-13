<?php

namespace App\Http\Resources\User;

use App\Http\Enum\User\UserStatusEnum;
use App\Http\Enum\User\UserTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->name ?? null,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'type' => $this->type ?? null,
            'address' => $this->address ?? null,
            'status' => $this->status ?? null,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'organization_id' => $this->organization_id ?? null,
            'created_by' => $this->created_by ?? null,
            'api_token' => $this->api_token ?? null
        ];
    }
}
