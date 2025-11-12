<?php

namespace App\Models\Organization;

use App\Models\OrganizationEmployee\OrganizationEmployee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
