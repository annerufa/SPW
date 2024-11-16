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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Customer /</span> Data Customer</h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Customer</h5>
                <div class="p-4 mf-2">
                    <div class="row">
                        <div class="col-md-12 float-end mr-4">
                            <a id="btn-cetak" href="{{url('cetakRekapCust')}}" 
                                class="btn btn-success float-end mr-4"
                                <span class="tf-icons bx bx-printer"></span>&nbsp; Cetak Rekap
                            </a>
                        </div>
                    </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="tabel-cust">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>IP</th>
                        <th>Kode Cust</th>
                        <th>Paket</th>
                        <th>Area</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="isi-cust">
                      @foreach($customer as $no=>$cust)
                        <tr>
                          <td>{{ ++$no}}</td>
                          <td>{{ $cust->nama_cust }}</td>
                          <td>{{ $cust->ip }}</td>
                          <td>{{ $cust->kode_cust }}</td>
                          <td>{{ $cust->paket->bandwidth }}</td>
                          <td>{{ $cust->area->nama_area }}</td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Second group">
                              <button type="button" class="btn btn-outline-primary" id="detail" data-id="{{ $cust->cust_id }}">
                                <i class="tf-icons bx bx-search-alt"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
                  <hr/>
                  {{ $customer->links() }}
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->


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
            <h5 class="card-header">Detail Customer</h5>
            <hr>
            <div class="table-responsive text-nowrap" style="width:500px;">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <td width="200px">Nama Customer</td>
                    <td id="namaE"></td>
                  </tr>
                  <tr>
                    <td>Kode Customer</td>
                    <td id="kodeE"></td>
                  </tr>
                  <tr>
                    <td>IP Address</td>
                    <td id="ipE"></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td id="addE"></td>
                  </tr>
                  <tr>
                    <td>No Telp</td>
                    <td id="noHpE"></td>
                  </tr>
                  <tr>
                    <td>Paket Wifi</td>
                    <td id="paketWifiE"></td>
                  </tr>
                  <tr>
                    <td>Area Pemasangan</td>
                    <td id="areaE"></td>
                  </tr>
                  <tr>
                    <td>Biaya Pemasangan</td>
                    <td id="biayaE"></td>
                  </tr>
                  <tr>
                    <td>Tanggal Pemasangan</td>
                    <td id="tglE">: </td>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
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
    $('body').delegate('#tabel-cust #detail', 'click',function(e){
        var id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
          url: `/customer/${id}`,
          type: "GET",
          cache: false,
          success:function(response){
            //fill data to form
            // $('#user_id').val(": ".response.user_id);
            $('#namaE').html(": "+response.nama_cust);
            $('#kodeE').html(": "+response.kode_cust);
            $('#addE').html(": "+response.alamat);
            $('#noHpE').html(": "+response.no_telp);
            $('#paketWifiE').html(": "+response.nama_paket);
            $('#areaE').html(": "+response.nama_area);
            $('#ipE').html(": "+response.ip);
            $('#biayaE').html(": "+response.biaya_pemasangan);
            $('#tglE').html(": "+response.tgl_pemasangan);

            //open modal
            $('#modalDetail').modal('show');
          }
        });
      });

      function handler(e){
          alert(e.target.value);
          $.ajax({
          type : "GET",
          url : "findRekap/"+e.target.value,
          // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          cache: false,
          success:function(response) {
            console.log("yo");
            refreshTable(response);  
            $("#btn-cetak").attr("href",("cetakCust/"+e.target.value));
          //   $('#modalTambah').modal('hide');
          //   showAlert(response.message);
          //   $('html').scrollTop(0); 
          //   $("#tambah-user")[0].reset();  
          }
        })
      }

      function refreshTable(response){
      $('#isi-cust').html('');
      $.each(response.data.customer, function (index, obj) {
        $('#isi-cust').append('' +
          '<tr>' +
          '<td>' + (index+1) + '</td>' +
          '<td>' + obj.nama_cust + '</td>' +
          '<td>' + obj.ip + '</td>' +
          '<td>' + obj.kd_cust + '</td>' +
          '<td>' + obj.paket.bandwidth + '</td>' +
          '<td>' + obj.area.nama_area + '</td>' +
          '<td>' + 
            '<div class="btn-group" role="group" aria-label="Second group">'+
            '<button type="button" class="btn btn-outline-primary" id="detail" data-id="'+ obj.user_id +'">'+
              '<i class="tf-icons bx bx-search-alt"></i></button> </div>'+
          '</td>' +
          '</tr>')
        });
        }

  </script>
  </body>
</html>
