<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    protected $table = 'Logs';
    protected $primaryKey = 'L_Id';
    public const CREATED_AT = 'L_CreatedAt';
    public const UPDATED_AT = 'L_UpdatedAt';
    public const DELETED_AT = 'L_DeletedAt';

    public function userDevice(): BelongsTo
    {
        return $this->belongsTo(UserDevices::class, 'L_UserDeviceId', 'UD_Id');
    }
}
