<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand" style="justify-content: center;margin-bottom:3px;">
            <div style="margin-top: 15px;margin-bottom: 10px;">
              <a href="index.html" class="app-brand-link">
                <span class="app-brand-text demo menu-text fw-bolder">SPPW</span>
              </a>
            </div>
            <img src="{{ URL::asset('assets/img/avatars/1.png')}}" alt class="w-px-100 h-auto rounded-circle" />
            
            <span style="text-align: center;margin-top:3px;">{{session('namaUser')}}</span>
            <span style="text-align: center;">{{session('userRole')}}</span>
            <!-- <p></p>
            <p style="text-align: center;">{{session('userRole')}}</p> -->
          </div>
          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->is('owner')or request()->is('/') ? 'active' : ''}}">
              <a href="{{url('/owner')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Pegawai -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pegawai</span>
            </li>
            <li class="menu-item {{ request()->is('user') ? 'active' : ''}}">
              <a href="{{url('/user')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Data Karyawan</div>
              </a>
            </li>

            <!-- Data Wifi -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Laporan</span>
            </li>
            <li class="menu-item {{ request()->is('rekapCust') ? 'active' : ''}}">
              <a href="{{url('/rekapCust')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Rekap Customer</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('rekapBayar') ? 'active' : ''}}">
              <a href="{{url('/rekapBayar')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Laporan Pembayaran</div>
              </a>
            </li>
            
          </ul>
        </aside>