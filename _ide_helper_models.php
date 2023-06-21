<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Cimlets
 *
 * @package App\Models
 * @version January 2, 2023, 3:04 pm UTC
 * @property string $name
 * @property integer $value
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClosureCimlets> $closurecimlets
 * @property-read int|null $closurecimlets_count
 * @method static \Database\Factories\CimletsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets withoutTrashed()
 */
	class Cimlets extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ClosureCimlets
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 * @property integer $closures_id
 * @property integer $cimlets_id
 * @property integer $value
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Cimlets|null $cimlets
 * @property-read \App\Models\Closures|null $closures
 * @property-read mixed $cash
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets closureClosureCimlets($id)
 * @method static \Database\Factories\ClosureCimletsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereCimletsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereClosuresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets withoutTrashed()
 */
	class ClosureCimlets extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Closures
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 * @property string $closuredate
 * @property integer $card
 * @property integer $szcard
 * @property integer $dayduring
 * @property int $id
 * @property int|null $dailysum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClosureCimlets> $closurecimlets
 * @property-read int|null $closurecimlets_count
 * @property-read mixed $cash
 * @property-read mixed $result
 * @method static \Database\Factories\ClosuresFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Closures newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures query()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYear($year)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYearMonth($year, $month)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYearSumResult($year)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereClosuredate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDailysum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDayduring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures withoutTrashed()
 */
	class Closures extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Invoices
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 * @property integer $partner_id
 * @property string $invoicenumber
 * @property integer $paymentmethod_id
 * @property integer $amount
 * @property string $dated
 * @property string $performancedate
 * @property string $deadline
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $payment_method_name
 * @property-read \App\Models\Partners|null $partner
 * @property-read \App\Models\PaymentMethods|null $paymentmethod
 * @method static \Database\Factories\InvoicesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices partnerInvoices($partner)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices partnerYearInvoices($partner = null, $year = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices partnerYearInvoicesSumAmount($partner = null, $year = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices thisYear($year)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereDated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereInvoicenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices wherePaymentmethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices wherePerformancedate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices yearInvoices($year)
 */
	class Invoices extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Monthstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $month
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
 * @property integer $card
 * @property integer $szcard
 * @property integer $cash
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $result
 * @property-read mixed $year_month
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked withoutTrashed()
 */
	class Monthstacked extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Offerdetails
 *
 * @package App\Models
 * @version February 3, 2023, 11:21 am UTC
 * @property integer $offers_id
 * @property integer $products_id
 * @property integer $quantities_id
 * @property integer $value
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Offers|null $offers
 * @property-read \App\Models\Products|null $products
 * @property-read \App\Models\Quantities|null $quantities
 * @method static \Database\Factories\OfferdetailsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereOffersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereQuantitiesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offerdetails withoutTrashed()
 */
	class Offerdetails extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Offers
 *
 * @package App\Models
 * @version February 3, 2023, 11:19 am UTC
 * @property string $offernumber
 * @property string $offerdate
 * @property integer $partners_id
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offerdetails> $offerdetails
 * @property-read int|null $offerdetails_count
 * @property-read \App\Models\Partners|null $partners
 * @method static \Database\Factories\OffersFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Offers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offers onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offers query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereOfferdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereOffernumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers wherePartnersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offers withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offers withoutTrashed()
 */
	class Offers extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PartnerTypes
 *
 * @package App\Models
 * @version January 2, 2023, 3:52 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partners> $partners
 * @property-read int|null $partners_count
 * @method static \Database\Factories\PartnerTypesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes withoutTrashed()
 */
	class PartnerTypes extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Partners
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
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
 * @property int $id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $full_address
 * @property-read mixed $settlement_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoices> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offers> $offers
 * @property-read int|null $offers_count
 * @property-read \App\Models\PartnerTypes|null $partnertypes
 * @property-read \App\Models\Settlements|null $settlement
 * @method static \Illuminate\Database\Eloquent\Builder|Partners activePartner()
 * @method static \Database\Factories\PartnersFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Partners inActivePartner()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereBankaccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners wherePartnertypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners wherePhonenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereSettlementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereTaxnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partners withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Partners withoutTrashed()
 */
	class Partners extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PaymentMethods
 *
 * @package App\Models
 * @version January 2, 2023, 3:43 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoices> $invoices
 * @property-read int|null $invoices_count
 * @method static \Database\Factories\PaymentMethodsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods withoutTrashed()
 */
	class PaymentMethods extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Products
 *
 * @package App\Models
 * @version February 2, 2023, 8:58 am UTC
 * @property string $name
 * @property integer $quantities_id
 * @property integer $price
 * @property string $description
 * @property int $id
 * @property int|null $supplierprice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offerdetails> $offerdetails
 * @property-read int|null $offerdetails_count
 * @property-read \App\Models\Quantities|null $quantities
 * @method static \Database\Factories\ProductsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereQuantitiesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSupplierprice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Products withoutTrashed()
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Quantities
 *
 * @package App\Models
 * @version February 2, 2023, 8:57 am UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offerdetails> $offerdetails
 * @property-read int|null $offerdetails_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\QuantitiesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities withoutTrashed()
 */
	class Quantities extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Settlements
 *
 * @package App\Models
 * @version January 3, 2023, 2:33 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property int $postcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partners> $partners
 * @property-read int|null $partners_count
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements withoutTrashed()
 */
	class Settlements extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $image_url
 * @property int|null $userstatus_id
 * @property string|null $commit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCommit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserstatusId($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Weekstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $week
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
 * @property integer $card
 * @property integer $szcard
 * @property integer $cash
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $result
 * @property-read mixed $week_of_m_onth
 * @property-read mixed $year_week
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked withoutTrashed()
 */
	class Weekstacked extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Yearstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
 * @property integer $card
 * @property integer $szcard
 * @property integer $cash
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $result
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getCardPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getCashPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getSzCardPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked withoutTrashed()
 */
	class Yearstacked extends \Eloquent {}
}

