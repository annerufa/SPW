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
            @if(session('message'))
            <div id="aler" style="position: absolute; width: 80%; padding: 1.625rem;">
              <div class="alert alert-success">{{session('message')}}</div>
            </div>
            @endisset
            <div id="aler"></div>
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pembayaran /</span> Data Pembayaran</h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Pembayaran</h5>
                <div class="pr-2">
                  <a href="{{url('/pembayaran/create')}}">
                      <button 
                        type="button" 
                        style="margin-right: 15px;"
                        class="btn btn-outline-success float-end mr-2">
                        <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah Pembayaran
                      </button>
                  </a>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="tabel-bayar">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tgl-Bayar</th>
                        <th>Pelanggan</th>
                        <th>Nominal</th>
                        <th>Metode Bayar</th>
                        <th>Terbayar</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tabel-bayar">
                      @foreach($bayars as $no=>$bayar)
                        <tr>
                          <td>{{ ++$no}}</td>
                          <td>{{ $bayar->tgl_pembayaran->format('d F Y') }}</td>
                          <td>{{ $bayar->customer->nama_cust }}</td>
                          <td>{{ $bayar->jumlah_bayar }}</td>
                          <td>{{ $bayar->metode_bayar }}</td>
                          <td>{{ $bayar->bulan_terbayar->format('F Y') }}</td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Second group">
                              <a href="{{url('/pembayaran/'.$bayar->bayar_id.'/edit')}}" class="btn btn-outline-warning">
                                <i class="tf-icons bx bx-pencil"></i>
                              </a>
                              <button type="button" class="btn btn-outline-primary" id="detail" data-id="{{ $bayar->bayar_id }}">
                                <i class="tf-icons bx bx-search-alt"></i>
                              </button> 
                              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                              data-bs-target="#modalHapus" id="del" data-id="{{ $bayar->bayar_id }}">
                                <i class="tf-icons bx bx-trash"></i>
                              </button>
                              <a href="{{url('/kwitansi/'.$bayar->bayar_id)}}" class="btn btn-outline-primary" >
                                <i class="tf-icons bx bx-printer"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

              <hr class="my-5" />

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
    
      <!-- Modal Detail data customer -->
      <div class="modal fade" id="modalDetail" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="card">
            <h5 class="card-header">Detail Pembayaran</h5>
            <hr>
            <div class="table-responsive text-nowrap" style="width:500px;">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <td width="200px">Nama Customer</td>
                    <td id="namaE"></td>
                  </tr>
                  <tr>
                    <td>Tanggal Bayar</td>
                    <td id="tglE"></td>
                  </tr>
                  <tr>
                    <td>Nominal</td>
                    <td id="nomE"></td>
                  </tr>
                  <tr>
                    <td>Bulan Terbayar</td>
                    <td id="blnE"></td>
                  </tr>
                  <tr>
                    <td>Metode Bayar</td>
                    <td id="metodeE"></td>
                  </tr>
                  <tr>
                    <td>Pegawai penerima</td>
                    <td id="userE"></td>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form id="del-form" action="" method="post">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Hapus Data Pembayaran</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <p>Yakin Hapus Data Pembayaran?</p>
                  <input type="hidden" id="del_id" value="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" value="Yakin" class="btn btn-danger" >
              <!-- <button id="yakin_hapus" type="submit">Yakin</button> -->
              <button type="button" class="btn btn-outline-secondary" 
              data-bs-dismiss="modal"
              aria-label="Batal">
                Batal
              </button>
            </div>
          </div>
        </form>
        </div>
      </div>

    </div>
    <!-- / Layout wrapper -->

    @include('layout/jsUser')
  <script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").alert('close');
      });
    // -----------------show Detail-------------
    $('body').delegate('#tabel-bayar #detail', 'click',function(e){
        var id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
          url: `/pembayaran/${id}`,
          type: "GET",
          cache: false,
          success:function(response){
            console.log(response.nama_cust);
            //fill data to form
            $('#namaE').html(": "+response.nama_cust);
            $('#tglE').html(": "+response.tgl_pembayaran);
            $('#nomE').html(": "+response.jumlah_bayar);
            $('#blnE').html(": "+response.bulan_terbayar);
            $('#metodeE').html(": "+response.metode_bayar);
            $('#userE').html(": "+response.nama);

            //open modal
            $('#modalDetail').modal('show');
          }
        });
      });
      // delete
      $('body').delegate('#tabel-bayar #del', 'click',function(e){
        var id = $(this).data('id');
        $('#del_id').val(id);
        $("#del-form").attr("action", "pembayaran/"+id);
        $('#modalHapus').modal('show');
      });

  </script>
  </body>
</html>
