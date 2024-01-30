<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDevices extends Model
{
    protected $table = 'UserDevices';
    protected $primaryKey = 'UD_Id';
    public const CREATED_AT = 'UD_CreatedAt';
    public const UPDATED_AT = 'UD_UpdatedAt';
    public const DELETED_AT = 'UD_DeletedAt';

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class, 'L_UserDeviceId', 'UD_Id');
    }
}
