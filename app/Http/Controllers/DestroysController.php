<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Classes\SWAlertClass;
use App\Models\Partners;

class DestroysController extends Controller
{
    public function beforeDestroys($table, $id, $route) {
        $view = 'layouts.show';
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztos, hogy törli a tételt?', '/'.$route, 'Kilép', '/destroy/'.$table.'/'.$id.'/'.$route, 'Töröl');

        return view($view)->with('table', $data);
    }

    public function beforeDestroysWithParam($table, $id, $route, $param = NULL) {
        $view = 'layouts.show';
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);
        $text = 'Törlődik a tétel és a hozzá kapcsolódó adatok! Biztos, hogy törli a tételt?';
        SWAlertClass::choice($id, $text, '/'.$route. '/' . $param, 'Kilép', '/destroyWithParam/'.$table.'/'.$id.'/'.$route. '/'.$param, 'Töröl');

        return view($view)->with('table', $data);
    }

    public function beforeDestroysWithParamArray($table, $id, $route, $param = NULL) {
        $view = 'layouts.show';
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);
        $text = 'Törlődik a tétel és a hozzá kapcsolódó adatok! Biztos, hogy törli a tételt?';
        SWAlertClass::choice($id, $text, '/'.$route. '/' . $param, 'Kilép', '/destroyWithParam/'.$table.'/'.$id.'/'.$route. '/'.$param, 'Töröl');

        return view($view)->with('table', $data);
    }

    public function destroy($table, $id, $route) {
        $route .= '.index';
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route));
        }

        $data->delete();

        return redirect(route($route));
    }

    public function destroyWithParam($table, $id, $route, $param) {
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route, $param));
        }

        $data->delete();
        return redirect(route($route,  $param));
    }

    public function beforePartnerActivation($id, $route) {
        $view = 'layouts.show';
        $data = Partners::find($id);
        SWAlertClass::choice($id, 'Biztosan változtatni akarja az aktívitás jelzőt?', '/'.$route, 'Kilép', '/partnerActivation/'.$id.'/'.$route, 'Váltás');

        return view($view)->with('table', $data);
    }

    public function partnerActivation($id, $route) {
        $route .= '.index';
        $partner = Partners::find($id);

        if (empty($partner)) {
            return redirect(route($route));
        }

        $partner->active = $partner->active == 0 ? 1 : 0;
        $partner->save();

        return redirect(route($route));
    }

}
