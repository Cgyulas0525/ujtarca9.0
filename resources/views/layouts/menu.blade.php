<li class="nav-item">
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ Request::is('dashb*') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <p>Indító pult</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link {{ Request::is('cimlets*') ||
                                   Request::is('paymentMethods*') ||
                                   Request::is('partnerTypes*') ? 'active' : '' }}">
        <i class="fas fa-university"></i>
        <p>Szótár<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('cimlets.index') }}"
               class="nav-link {{ Request::is('cimlets*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-alt"></i>
                <p>Cimlet</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('paymentMethods.index') }}"
               class="nav-link {{ Request::is('paymentMethods*') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <p>Fizetési mód</p>
            </a>
        </li>
    <li class="nav-item">
        <a href="{{ route('partnerTypes.index') }}"
           class="nav-link {{ Request::is('partnerTypes*') ? 'active' : '' }}">
            <i class="fas fa-user-tag"></i>
            <p>Partner típus</p>
        </a>
    </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('partners.index') }}"
       class="nav-link {{ Request::is('partners*') ? 'active' : '' }}">
        <i class="fas fa-handshake"></i>
        <p>Partner</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('invoices.index') }}"
       class="nav-link {{ Request::is('invoices*') ? 'active' : '' }}">
        <i class="fas fa-file-invoice"></i>
        <p>Számla</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('closures.index') }}"
       class="nav-link {{ Request::is('closures*') ? 'active' : '' }}">
        <i class="fas fa-wallet"></i>
        <p>Zárás</p>
    </a>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Riportok<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="RevenueExpenditureIndex" class="nav-link">
                <i class="fas fa-tasks"></i>
                <p>Heti Bevétel - Kiadás</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="RevenueExpenditureMonthIndex" class="nav-link">
                <i class="fas fa-table"></i>
                <p>Havi Bevétel - Kiadás</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="TurnoverIndex" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <p>Árbevétel</p>
            </a>
        </li>
    </ul>
</li>




