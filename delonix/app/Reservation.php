<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $reservation_id
 * @property int $room_id
 * @property string $cust_id
 * @property string $checkin
 * @property string $checkout
 * @property string $paymentstatus
 * @property string $transaction_id
 * @property string $paymentmethod
 * @property string $created_at
 * @property string $deleted_at
 * @property string $updated_at
 */
class Reservation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservation';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'reservation_id';

    /**
     * @var array
     */
    protected $fillable = ['room_id', 'cust_id', 'checkin', 'checkout', 'paymentstatus', 'transaction_id', 'paymentmethod', 'created_at', 'deleted_at', 'updated_at', 'amount'];

}
