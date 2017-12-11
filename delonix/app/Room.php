<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $room_id
 * @property string $room_type
 * @property float $room_price
 * @property string $updated_at
 * @property string $created_at
 * @property string $deleted_at
 * @property string $room_name
 */
class Room extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Room';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'room_id';

    /**
     * @var array
     */
    protected $fillable = ['room_type', 'room_price', 'updated_at', 'created_at', 'deleted_at', 'room_name'];

}
