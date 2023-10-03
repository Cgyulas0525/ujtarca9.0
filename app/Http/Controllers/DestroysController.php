<?php

namespace App\Http\Controllers;

use App\Classes\BeforeActionClass;
use App\Enums\ActiveEnum;
use Illuminate\Http\Request;
use App\Services\SWAlertService;
use App\Models\Partners;
use App\Models\Products;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use App\Classes\RedisClass;

class DestroysController extends Controller
{
    public function beforeDestroys($table, $id, $route): object
    {
        $model_name = 'App\Models\\' . $table;
        $data = $model_name::find($id);
        SWAlertService::choice($id, 'Biztos, hogy törli a tételt?', '/' . $route, 'Kilép', '/destroy/' . $table . '/' . $id . '/' . $route, 'Töröl');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function beforeDestroysWithParam($table, $id, $route, $param = NULL): object
    {
        $model_name = 'App\Models\\' . $table;
        $data = $model_name::find($id);
        $text = 'Törlődik a tétel és a hozzá kapcsolódó adatok! Biztos, hogy törli a tételt?';
        SWAlertService::choice($id, $text, '/' . $route . '/' . $param, 'Kilép', '/destroyWithParam/' . $table . '/' . $id . '/' . $route . '/' . $param, 'Töröl');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function beforeDestroysWithParamArray($table, $id, $route, $param = NULL): object
    {
        $model_name = 'App\Models\\' . $table;
        $data = $model_name::find($id);
        $text = 'Törlődik a tétel és a hozzá kapcsolódó adatok! Biztos, hogy törli a tételt?';
        SWAlertService::choice($id, $text, '/' . $route . '/' . $param, 'Kilép', '/destroyWithParam/' . $table . '/' . $id . '/' . $route . '/' . $param, 'Töröl');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function destroy($table, $id, $route): object
    {
        $route .= '.index';
        $model_name = 'App\Models\\' . $table;
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route));
        }

        $data->delete();

        return redirect(route($route));
    }

    public function destroyWithParam($table, $id, $route, $param): object
    {
        $model_name = 'App\Models\\' . $table;
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route, $param));
        }

        $data->delete();
        return redirect(route($route, $param));
    }

    public function beforePartnerActivation($id, $route): object
    {
        $data = Partners::find($id);
        SWAlertService::choice($id, 'Biztosan változtatni akarja az aktívitás jelzőt?', '/' . $route, 'Kilép', '/partnerActivation/' . $id . '/' . $route, 'Váltás');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function partnerActivation($id, $route): object
    {
        $route .= '.index';
        $partner = Partners::find($id);

        if (empty($partner)) {
            return redirect(route($route));
        }

        $partner->active = ($partner->active == ActiveEnum::INACTIVE) ? ActiveEnum::ACTIVE->value : ActiveEnum::INACTIVE->value;
        $partner->save();

        RedisClass::setexPartners();

        return redirect(route($route));
    }

    public function beforeProductActivation($id, $route): object
    {
        $data = Products::find($id);
        SWAlertService::choice($id, 'Biztosan változtatni akarja az aktívitás jelzőt?', '/' . $route, 'Kilép', '/productActivation/' . $id . '/' . $route, 'Váltás');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function productActivation($id, $route): object
    {
        $route .= '.index';
        $product = Products::find($id);

        if (empty($product)) {
            return redirect(route($route));
        }

        $product->active = ($product->active == ActiveEnum::INACTIVE) ? ActiveEnum::ACTIVE->value : ActiveEnum::INACTIVE->value;
        $product->save();

        RedisClass::setexProducts();

        return redirect(route($route));
    }
}
