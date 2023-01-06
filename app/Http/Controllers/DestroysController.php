<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Classes\SWAlertClass;

use App\Models\Contractdeadlineitem;

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

    public function deletingContractAnnex($data) {
        if (!is_null($data->document_url)) {
            unlink($data->document_url);
        }
    }

    public function deletingContractDeadLine($data) {
        Contractdeadlineitem::where('contractdeadline_id', $data->id)->delete();
    }


    public function destroyWithParam($table, $id, $route, $param) {
        $model_name = 'App\Models\\'.$table;
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route, $param));
        }

        switch (strtolower($table)) {
            case "contractannex":
                $this->deletingContractAnnex($data);
                break;
            case "contractdeadline":
                $this->deletingContractDeadLine($data);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        $data->delete();
        return redirect(route($route,  $param));
    }

}
