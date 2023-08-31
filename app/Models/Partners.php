<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Partners
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 *
 * @property string $name
 * @property integer $partnertypes_id
 * @property string $taxnumber
 * @property string $bankaccount
 * @property integer $postcode
 * @property integer $settlement_id
 * @property string $address
 * @property string $email
 * @property string $phonenumber
 * @property string $description
 * @property integer $active
 */
class Partners extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'partners';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'partnertypes_id',
        'taxnumber',
        'bankaccount',
        'postcode',
        'settlement_id',
        'address',
        'email',
        'phonenumber',
        'description',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'partnertypes_id' => 'integer',
        'taxnumber' => 'string',
        'bankaccount' => 'string',
        'postcode' => 'integer',
        'settlement_id' => 'integer',
        'address' => 'string',
        'email' => 'string',
        'phonenumber' => 'string',
        'description' => 'string',
        'active' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'partnertypes_id' => 'nullable|integer',
        'taxnumber' => 'nullable|string|max:15',
        'bankaccount' => 'nullable|string|max:30',
        'postcode' => 'nullable|integer',
        'settlement_id' => 'nullable|integer',
        'address' => 'nullable|string|max:100',
        'email' => 'nullable|string|max:50',
        'phonenumber' => 'nullable|string|max:20',
        'description' => 'nullable|string|max:500',
        'active' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = ['settlementName', 'fullAddress'];

    public function partnertypes() {
        return $this->belongsTo(Partnertypes::class, 'partnertypes_id');
    }

    public function settlement() {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }

    public function invoices() {
        return $this->hasMany(Invoices::class, 'partner_id');
    }

    public function offers() {
        return $this->hasMany(Offers::class, 'partners_id');
    }

    public function aviable() {
        return (empty(Invoices::where('partner_id', $this->id)->first()) && empty(Offers::where('partners_id', $this->id)->first())) ? true : false;
    }

    public function getSettlementNameAttribute() {
        return (empty($this->settlement_id) || $this->settlement_id == 0) ? '' : Settlements::find($this->settlement_id)->name;
    }

    public function getFullAddressAttribute() {
        return (empty($this->postcode) ? '' : $this->postcode) . " " . (empty($this->settlement_id) ? '' : Settlements::find($this->settlement_id)->name) . ' ' . (empty($this->address) ? '' : $this->address);
    }

    public function scopeActivePartner($query) {
        return $query->where('active', 1);
    }

    public function scopeInActivePartner($query) {
        return $query->where('active', 0);
    }
}
