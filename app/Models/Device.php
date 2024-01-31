<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Device extends Model
{
    protected $table = 'Devices';
    //temporarily
    protected $guarded = [];
    protected $primaryKey = 'D_Id';
    public const CREATED_AT = 'D_CreatedAt';
    public const UPDATED_AT = 'D_UpdatedAt';
    public const DELETED_AT = 'D_DeletedAt';

    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'UserDevices', 'UD_DeviceId', 'UD_UserId');
    }

}
