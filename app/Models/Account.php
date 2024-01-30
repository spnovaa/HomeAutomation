<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    protected $table = 'Accounts';
    protected $primaryKey = 'A_Id';
    public const CREATED_AT = 'A_CreatedAt';
    public const UPDATED_AT = 'A_UpdatedAt';
    public const DELETED_AT = 'A_DeletedAt';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'A_UserId', 'U_Id');
    }
}
