<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Invoices
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 *
 * @property integer $partner_id
 * @property string $invoicenumber
 * @property integer $paymentmethod_id
 * @property integer $amount
 * @property string $dated
 * @property string $performancedate
 * @property string $deadline
 * @property string $description
 */
class Invoices extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'invoices';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'partner_id',
        'invoicenumber',
        'paymentmethod_id',
        'amount',
        'dated',
        'performancedate',
        'deadline',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'partner_id' => 'integer',
        'invoicenumber' => 'string',
        'paymentmethod_id' => 'integer',
        'amount' => 'integer',
        'dated' => 'date',
        'performancedate' => 'date',
        'deadline' => 'date',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'partner_id' => 'required|integer',
        'invoicenumber' => 'required|string|max:25',
        'paymentmethod_id' => 'required|integer',
        'amount' => 'required|integer',
        'dated' => 'required',
        'performancedate' => 'required',
        'deadline' => 'required',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function paymentmethod() {
        return $this->belongsTo(PaymentMethods::class, 'paymentmethod_id');
    }

    public function partner() {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function scopeThisYear($query, $year) {
        return $query->whereYear('dated', $year);
    }
}
