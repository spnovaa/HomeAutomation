<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'U_Id';
    public const CREATED_AT = 'U_CreatedAt';
    public const UPDATED_AT = 'U_UpdatedAt';
    public const DELETED_AT = 'U_DeletedAt';

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'A_UserId', 'U_Id');
    }

    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class, 'UserDevices', 'UD_UserId', 'UD_DeviceId');
    }

}
