<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $admin_id
 * @property string $admin_username
 * @property string $admin_password
 * @property string $admin_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admin';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'admin_id';

    /**
     * @var array
     */
    protected $fillable = ['admin_username', 'admin_password', 'admin_name', 'created_at', 'updated_at', 'deleted_at'];

}
