<?php
namespace App\Modules\Organization\Http\Resources\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginOrganizationEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'type' => $this->type,
            'organization_id' => $this->organization_id,
            'is_master' => $this->is_master,
            'token' => $this->token
        ];
    }
}
