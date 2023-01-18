<?php

/*
 * Tárca adatbázisból a Budget adatbázisba konvertálás
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\PaymentMethods;
use App\Models\PartnerTypes;
use App\Models\Partners;
use App\Models\ClosureCimlets;
use App\Models\Cimlets;
use App\Models\Settlements;

class DataConvertController extends Controller
{

    public function paymentMethodsConvert() {

        foreach (DB::connection('mysql_tarca')->table('dictionaries')
                     ->where('tipus', 25)->get() as $data) {
            $paymentMethod = PaymentMethods::where('name', $data->nev)->first();
            if (empty($paymentMethod)) {
                $paymentMethods = new PaymentMethods();
                $paymentMethods->name = $data->nev;
                $paymentMethods->description = $data->id;
                $paymentMethods->save();
            }
        }

    }

    public function partnerTypesCovert() {

        foreach (DB::connection('mysql_tarca')->table('dictionaries')
                     ->where('tipus', 24)->get() as $data) {
            $partnertypes= PartnerTypes::where('name', $data->nev)->first();
            if (empty($partnertypes)) {
                $partnertypes = new PartnerTypes();
                $partnertypes->name = $data->nev;
                $partnertypes->description = $data->id;
                $partnertypes->save();
            }
        }

    }

    public function partnersConvert() {

        foreach (DB::connection('mysql_tarca')->table('partner')->get() as $data) {
            $partner = new Partners();
            $partner->name = $data->nev;
            $partner->partnertypes_id = PartnerTypes::where('description', $data->tipus)->first()->id;
            $partner->taxnumber = $data->adoszam;
            $partner->bankaccount = $data->bankszamla;
            $partner->postcode = $data->isz;
            $partner->settlement_id = $data->telepules;
            $partner->address = $data->cim;
            $partner->email = $data->email;
            $partner->phonenumber = $data->telefonszam;
            $partner->description = $data->megjegyzes;
            $partner->save();
        }
    }

    public function getPartner($id)
    {
        $tarcaPartner = DB::connection('mysql_tarca')->table('partner')->where('id', $id)->first();
        return DB::connection('mysql')->table('partners')->where('name', $tarcaPartner->nev)->first()->id;
    }

    public function invoiceConvert() {
        foreach (DB::connection('mysql_tarca')->table('szamla')->whereNull('deleted_at')->get() as $data) {

            $invoice = new Invoices();
            $invoice->partner_id = $this->getPartner($data->partner);
            $invoice->invoicenumber = $data->szamlaszam;
            $invoice->paymentmethod_id = PaymentMethods::where('description', $data->fizitesimod)->first()->id;
            $invoice->amount = $data->osszeg;
            $invoice->dated = $data->kelt;
            $invoice->performancedate = $data->teljesites;
            $invoice->deadline = $data->fizetesihatarido;
            $invoice->description = $data->id;

            $invoice->save();
        }
    }

    public function cc($cimlet, $closure, $value) {
        $closureCimlet = new ClosureCimlets();
        $closureCimlet->closures_id = $closure;
        $closureCimlet->cimlets_id = $cimlet;
        $closureCimlet->value = $value;
        $closureCimlet->save();
    }

    public function closureConvert() {

        $zaras = DB::connection('mysql_tarca')->table('zaras')->whereNull('deleted_at')->get();

        foreach ($zaras as $item) {

        $closure = DB::table('closures')
            ->insertGetId([
            'closuredate' => $item->datum,
            'card'        => $item->kartya,
            'szcard'      => $item->szep,
            'dayduring'   => $item->napkozben,
        ]);

        $this->cc(Cimlets::where('value', 5)->first()->id, $closure, $item->A5);
        $this->cc(Cimlets::where('value', 10)->first()->id, $closure, $item->A10);
        $this->cc(Cimlets::where('value', 20)->first()->id, $closure, $item->A20);
        $this->cc(Cimlets::where('value', 50)->first()->id, $closure, $item->A50);
        $this->cc(Cimlets::where('value', 100)->first()->id, $closure, $item->A100);
        $this->cc(Cimlets::where('value', 200)->first()->id, $closure, $item->A200);
        $this->cc(Cimlets::where('value', 500)->first()->id, $closure, $item->A500);
        $this->cc(Cimlets::where('value', 1000)->first()->id, $closure, $item->A1000);
        $this->cc(Cimlets::where('value', 2000)->first()->id, $closure, $item->A2000);
        $this->cc(Cimlets::where('value', 5000)->first()->id, $closure, $item->A5000);
        $this->cc(Cimlets::where('value', 10000)->first()->id, $closure, $item->A10000);
        $this->cc(Cimlets::where('value', 20000)->first()->id, $closure, $item->A20000);
        }
    }

    public function settlementsConvert() {

        $telepules = DB::connection('mysql_tarca')->table('telepules')->get();

        foreach ($telepules as $item) {
        echo $item->iranyitoszam . " " . $item->telepules . "\n";
        $settlement = new Settlements();
        $settlement->postcode = $item->iranyitoszam;
        $settlement->name = $item->telepules;
        $settlement->created_at = \Carbon\Carbon::now();
        $settlement->save();

    }

}

}




