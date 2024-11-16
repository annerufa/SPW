<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand" style="justify-content: center;">
        <div style="margin-top: 15px;margin-bottom: 10px;text-align: center;">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-text demo menu-text fw-bolder">SPPW</span>
            </a>
        </div>
        <div>
            <img src="{{ URL::asset('assets/img/avatars/6.png')}}" alt class="w-px-100 h-auto rounded-circle" />
            <p style="text-align: center;margin-top: 3px;margin-bottom:3px;">{{session('namaUser')}}</p>
            <p style="text-align: center;">{{session('userRole')}}</p>
        </div>
    </div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->

        <li class="menu-item  {{ request()->is('pegawai') ? 'active' : ''}}">
          <a href="{{url('/pegawai')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <!-- Customer -->
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Customer</span>
        </li>
        <li class="menu-item {{ (request()->is('customer/create') or request()->is('customer')) ? 'active' : ''}}">
          <a href="{{url('/customer')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
            <div data-i18n="Analytics">Data Customer</div>
          </a>
        </li>            

        <!-- Pembayaran -->
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Pembayaran</span>
        </li>
        <li class="menu-item">
          <a href="{{url('/scan')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
            <div data-i18n="Analytics">Scan QR Code</div>
          </a>
        </li>
        <li class="menu-item {{ (request()->is('pembayaran/create') or request()->is('pembayaran')) ? 'active' : ''}}">
          <a href="{{url('/pembayaran')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
            <div data-i18n="Analytics">Data Pembayaran</div>
          </a>
        </li>
        
        <!-- Laporan -->
        
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Laporan</span>
        </li>
        <li class="menu-item">
          <a href="{{url('/rekapCust')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-archive"></i>
            <div data-i18n="Basic">Rekap Data Customer</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{url('/rekapBayar')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-file-archive"></i>
            <div data-i18n="Basic">Laporan Pembayaran</div>
          </a>
        </li>
        <br>
      </ul>
</aside>