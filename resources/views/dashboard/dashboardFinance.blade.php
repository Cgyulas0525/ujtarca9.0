<div class="row">
    @include('dashboard.dashboardFinanceItem', ['title' => 'Zárás',
                                                'route' => 'closures.index',
                                                'icon' => 'ion ion-bag',
                                                'box' => 'small-box bg-danger',
                                                'label' => date('Y'),
                                                'endlabel' => 'ft',
                                                'function' => number_format((!is_null($params['stacked']['first']) ? $params['stacked']['first']->revenue : 0),0,",",".") ])
    @include('dashboard.dashboardFinanceItem', ['title' => 'Számla',
                                                'route' => 'invoices.index',
                                                'icon' => 'ion ion-stats-bars',
                                                'box' => 'small-box bg-warning',
                                                'label' => date('Y'),
                                                'endlabel' => 'ft',
                                                'function' => number_format((!is_null($params['stacked']['first']) ? $params['stacked']['first']->spend : 0),0,",",".") ])
    @include('dashboard.dashboardFinanceItem', ['title' => 'Eredmény',
                                                'route' => 'TurnoverIndex',
                                                'icon' => 'ion-pie-graph',
                                                'box' => 'small-box bg-success',
                                                'label' => date('Y'),
                                                'endlabel' => 'ft',
                                                'function' => number_format((!is_null($params['stacked']['first']) ? $params['stacked']['first']->result : 0),0,",",".") ])
    @include('dashboard.dashboardFinanceItem', ['title' => 'Partner',
                                                'route' => 'partners.index',
                                                'icon' => 'ion ion-person-add',
                                                'box' => 'small-box bg-info',
                                                'label' => 'Össz',
                                                'endlabel' => 'db',
                                                'function' => number_format(App\Models\Partners::count(),0,",",".") ])
</div>

