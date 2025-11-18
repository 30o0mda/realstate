<?php

namespace App\Modules\Organization\Models\organizationEmployee;
use App\Modules\Organization\Models\Organization\Organization;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class OrganizationEmployee extends Authenticatable
{
        use HasApiTokens, Notifiable;

    protected $table = 'organization_employees';



    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'type',
        'image',
        'is_master',
        'organization_id',
        'address',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
