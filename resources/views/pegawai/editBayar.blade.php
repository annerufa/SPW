@include('layout/header2')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         @include('layout/sidebar-pegawai')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layout/navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Customer /</span> Ubah Data Customer</h4>
  
                <!-- Basic Layout & Basic with Icons -->
                <div class="row">
                  <!-- Basic with Icons -->
                  <div class="col-xxl">
                    <div class="card mb-4">
                      <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Form Ubah Pembayaran</h5>
                        <!-- <small class="text-muted float-end">Merged input group</small> -->
                      </div>
                      <div class="card-body">
                        <form action="{{url('/pembayaran/'.$bayar->bayar_id)}}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" name="bayar_id" value="{{$bayar->bayar_id}}" >
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" >Kode Customer</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" name="kd_cust" value="{{$bayar->customer->kode_cust}}" class="form-control" required/>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tanggal Bayar</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" name="tgl_bayar" type="date" value="{{ $bayar->tgl_pembayaran->format('Y-m-d') }}" id="html5-date-input" required>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nominal Bayar</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-money"></i></span>
                                <input type="number" name="nominal" value="{{$bayar->jumlah_bayar}}"  class="form-control" required/>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Bulan Terbayar</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" name="bln_bayar" type="date" value="{{ $bayar->bulan_terbayar->format('Y-m-d') }}" id="html5-date-input" required>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" >Metode Bayar</label>
                            <div class="col-sm-10">
                                <select name="metode" id="" class="form-select"required>
                                    <option data-tokens="" value="">- Pilih Metode Bayar -</option>
                                        @if($bayar->metode_bayar=="Tunai")
                                            <option value="Tunai" selected class="form-control">Tunai</option>
                                            <option value="Transfer"  class="form-control">Transfer</option>
                                        @else
                                        <option value="Tunai"  class="form-control">Tunai</option>
                                            <option value="Transfer" selected class="form-control">Transfer</option>
                                        @endif
                                        
                                </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ket</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" name="ket" value="{{$bayar->ket}}"  class="form-control" placeholder="BRI"/>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-end">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>
                          
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
  
                <hr class="my-5" />
  
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Kelompok 1 Kelas P2K TeknikInformatika Unisba</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <!-- / Layout wrapper -->

    @include('layout/jsUser')
    <script type="text/javascript">
      console.log();
    </script>

  </body>
</html>