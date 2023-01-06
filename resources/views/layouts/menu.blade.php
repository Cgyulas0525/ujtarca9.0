<li class="nav-item">
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ Request::is('dashb*') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <p>Indító pult</p>
    </a>
</li>
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


<li class="nav-item">
    <a href="{{ route('partners.index') }}"
       class="nav-link {{ Request::is('partners*') ? 'active' : '' }}">
        <i class="fas fa-handshake"></i>
        <p>Partner</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('invoices.index', ['ev' => null, 'partner' => null]) }}"
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




