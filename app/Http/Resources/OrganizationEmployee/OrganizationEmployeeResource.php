<?php

namespace App\Http\Resources\OrganizationEmployee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class OrganizationEmployeeResource extends JsonResource
{
    protected $token;

    public function __construct($resource, $token)
    {
        parent::__construct($resource);
        $this->token = $token;
    }


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
            'phone' => $this->phone ?? null,
            'organization_id' => $this->organization_id ?? null,
            'token' => $this->token,
            'type' => $this->type ?? null,
            'is_master' => $this->is_master ?? null,
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,


        ];
    }
}
