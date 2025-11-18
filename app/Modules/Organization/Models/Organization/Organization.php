<?php

namespace App\Modules\Organization\Models\Organization;

use App\Modules\Organization\Models\organizationEmployee\OrganizationEmployee;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Organization extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'type',
        'image',
    ];
    public function employees()
    {
        return $this->hasMany(OrganizationEmployee::class);
    }
}
