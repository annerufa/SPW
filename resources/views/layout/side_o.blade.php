<!-- Menu -->
<aside id="layout-menu" class="layout-menu-fixed menu-vertical menu bg-menu-theme">
    <div class="app-br">
    <a href="index.html" class="">
        <span class="app-brand-text demo menu-text fw-bolder">SPPW</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
    </div>

    <div class="app-profil">
    <div class="ava">
        <img src="{{ URL::asset('assets/img/avatars/7.png')}}" alt class="w-px-100 h-auto rounded-circle" />
    </div>
    <p class="text-center">Mr. Owner</p>
    </div>

    <ul class="menu-inner py-1">
    <!-- Dashboard -->

    <li class="menu-item">
        <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pegawai</span>
    </li>
    <li class="menu-item active">
        <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
        <div data-i18n="Analytics">Data Pegawai</div>
        </a>
    </li>
    
    <!-- Layouts -->
    
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Laporan</span>
    </li>
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-archive"></i>
        <div data-i18n="Basic">Rekap Data Customer</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-archive"></i>
        <div data-i18n="Basic">Laporan Pembayaran</div>
        </a>
    </li>
    </ul>
</aside>
<!-- / Menu -->