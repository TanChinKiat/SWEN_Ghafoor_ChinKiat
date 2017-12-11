<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $staffid
 * @property string $staff_username
 * @property string $staff_bankaccount
 * @property string $staff_password
 * @property string $staff_dob
 * @property string $staff_address
 * @property string $staff_name
 * @property string $staff_no
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Staff extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Staff';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'staffid';

    /**
     * @var array
     */
    protected $fillable = ['staff_username', 'staff_bankaccount', 'staff_password', 'staff_dob', 'staff_address', 'staff_name', 'staff_no', 'created_at', 'updated_at', 'deleted_at'];

}
