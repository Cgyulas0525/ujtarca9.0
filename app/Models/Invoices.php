<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'dated' => 'required|date',
        'performancedate' => 'required|date',
        'deadline' => 'required|date|after_or_equal:dated',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'paymentMethodName'
    ];

    public function getPaymentMethodNameAttribute(): string
    {
        return !empty($this->paymentmethod_id) ? PaymentMethods::find($this->paymentmethod_id)->name : '';
    }

    public function paymentmethod(): string|BelongsTo
    {
        return $this->belongsTo(PaymentMethods::class, 'paymentmethod_id');
    }

    public function partner(): string|BelongsTo
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function scopeThisYear($query, $year): mixed
    {
        return $query->whereYear('dated', $year);
    }

    public function scopePartnerInvoices($query, $partner): mixed
    {
        return $query->where(function ($q) use ($partner) {
            if (is_null($partner)) {
                $q->whereNotNull('partner_id');
            } else {
                $q->where('partner_id', $partner);
            }
        });
    }

    public function scopeYearInvoices($query, $year): mixed
    {
        return $query->where(function ($q) use ($year) {
            if (is_null($year) || ($year == -9999)) {
                $q->whereNotNull('dated');
            } else {
                $q->whereYear('dated', $year);
            }
        });
    }

    public function scopePartnerYearInvoices($query, $partner = null, $year = null): mixed
    {
        return $query->where(function ($q) use ($partner) {
            if (is_null($partner)) {
                $q->whereNotNull('partner_id');
            } else {
                $q->where('partner_id', $partner);
            }
        })->where(function ($q) use ($year) {
            if (is_null($year) || ($year == -9999)) {
                $q->whereNotNull('dated');
            } else {
                $q->whereYear('dated', $year);
            }
        });
    }

    public function scopePartnerYearInvoicesSumAmount($query, $partner = null, $year = null): mixed
    {
        return $query->PartnerYearInvoices($partner, $year)->sum('amount');
    }
}
