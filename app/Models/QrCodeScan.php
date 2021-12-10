<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeScan extends Model
{
    use HasFactory;   

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'restaurant_id',
        'week1',
        'week2',
        'week3',
        'week4',
        'week5',
        'week6',
        'week7',
        'week8',
        'week9',
        'week10',
        'week11',
        'week12',
        'week13',
        'week14',
        'week15',
        'week16',
        'week17',
        'week18',
        'week19',
        'week20',
        'week21',
        'week22',
        'week23',
        'week24',
        'week25',
        'week26',
        'week27',
        'week28',
        'week29',
        'week30',
        'week31',
        'week32',
        'week33',
        'week34',
        'week35',
        'week36',
        'week37',
        'week38',
        'week39',
        'week40',
        'week41',
        'week42',
        'week43',
        'week44',
        'week45',
        'week46',
        'week47',
        'week48',
        'week49',
        'week50',
        'week51',
        'week52'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        //
    ];
}
