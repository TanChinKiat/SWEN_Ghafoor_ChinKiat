<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cust_id
 * @property string $cust_name
 * @property string $cust_email
 * @property int $cust_no
 * @property string $Cust_address
 * @property string $updated_at
 * @property string $created_at
 * @property string $deleted_at
 * @property string $cust_creditcard
 * @property int $cust_creditcard_mm
 * @property int $cust_creditcard_yy
 */
class Customer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Customer';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cust_id';

    /**
     * @var array
     */
    protected $fillable = ['cust_name', 'cust_email', 'cust_no', 'Cust_address', 'updated_at', 'created_at', 'deleted_at', 'cust_creditcard', 'cust_creditcard_mm', 'cust_creditcard_yy'];

}
