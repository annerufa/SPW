@include('layout/header2')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         @include('layout/sidebar-owner')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layout/navbar')
 
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div id="aler" style="position: absolute; width: 80%; padding: 1.625rem;"></div>
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Karyawan /</span> Data Karyawan</h4>

              <!-- modal CRUD -->
              
      <!-- Modal  Form tambah pegawai-->
      <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <form class="modal-content" id="tambah-user" method="post" action="{{url('/user')}}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="backDropModalTitle">Form Tambah Pegawai</h5>
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
                  <label for="nameBackdrop" class="form-label">Nama Lengkap</label>
                  <input
                    type="text"
                    id="nameBackdrop"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan Nama"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="addBackdrop" class="form-label">Alamat</label>
                  <input
                    type="text"
                    id="addBackdrop"
                    name="alamat"
                    class="form-control"
                    placeholder="Masukkan alamat"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="emailBackdrop" class="form-label">Email</label>
                  <input
                    type="text"
                    id="emailBackdrop"
                    name="email"
                    class="form-control"
                    placeholder="xxxx@xxx.xx"
                  />
                </div>
                <div class="col mb-0">
                  <label for="dobBackdrop" class="form-label">No telp</label>
                  <input
                    type="text"
                    id="dobBackdrop"
                    name="noHp"
                    class="form-control"
                    placeholder="08x xxx xxx xxx"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="usernameBackdrop" class="form-label">Username</label>
                  <input
                    type="text"
                    id="usernameBackdrop"
                    class="form-control"
                    name="username"
                    placeholder="Masukkan Username"
                  />
                </div>
                <div class="col mb-0">
                  <label for="passBackdrop" class="form-label">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      id="passBackdrop"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                  </div>
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Modal  Form ubah pegawai-->
      <div class="modal fade" id="modalUbah" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <form class="modal-content" id="ubah-user" method="post" action="{{url('/user')}}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="backDropModalTitle">Form Tambah Pegawai</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <input type="number" id="user_id" name="user_id" hidden/>
              <div class="row">
                <div class="col mb-3">
                  <label for="namaE" class="form-label">Nama Lengkap</label>
                  <input
                    type="text"
                    id="namaE"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan Nama"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="addE" class="form-label">Alamat</label>
                  <input
                    type="text"
                    id="addE"
                    name="alamat"
                    class="form-control"
                    placeholder="Masukkan alamat"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="emailE" class="form-label">Email</label>
                  <input
                    type="text"
                    id="emailE"
                    name="email"
                    class="form-control"
                    placeholder="xxxx@xxx.xx"
                  />
                </div>
                <div class="col mb-0">
                  <label for="noHpE" class="form-label">No telp</label>
                  <input
                    type="text"
                    id="noHpE"
                    name="noHp"
                    class="form-control"
                    placeholder="08x xxx xxx xxx"
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="usernameE" class="form-label">Username</label>
                  <input
                    type="text"
                    id="usernameE"
                    class="form-control"
                    name="username"
                    placeholder="Masukkan Username"
                  />
                </div>
                <div class="col mb-0">
                  <label for="passE" class="form-label">Password</label>
                  <input
                    type="text"
                    id="passE"
                    class="form-control"
                    name="password"
                  />
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Hapus Data Karyawan?</h5>
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
                  <p>Yakin Hapus Data Karyawan?<span id="namaKar"></span></p>
                  <input type="hidden" id="del_id" value="">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button id="yakin_hapus" class="btn btn-danger">Yakin</button>
              <button type="button" class="btn btn-outline-secondary" 
              data-bs-dismiss="modal"
              aria-label="Batal">
                Batal
              </button>
            </div>
          </div>
        </div>
      </div>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Pegawai</h5>
                <div class="pr-2">
                  <button 
                    type="button" 
                    style="margin-right: 15px;"
                    class="btn btn-outline-success float-end mr-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                    <span class="tf-icons bx bx-user-plus"></span>&nbsp; Tambah Karyawan
                  </button>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="tabel-user">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tabel-pegawai">
                      @foreach($users as $no=>$user)
                        <tr>
                          <td>{{ ++$no}}</td>
                          <td>{{ $user->nama }}</td>
                          <td>{{ $user->alamat }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->noHp }}</td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Second group">
                              <button type="button" class="btn btn-outline-warning" id="edit" data-id="{{ $user->user_id }}">
                                <i class="tf-icons bx bx-pencil"></i>
                              </button>
                              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                              data-bs-target="#modalHapus" id="del" data-id="{{ $user->user_id }}">
                                <i class="tf-icons bx bx-trash"></i>
                              </button>
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

    </div>
    <!-- / Layout wrapper -->

    @include('layout/jsUser')

    <script type="text/javascript">
      function showAlert(msg) {
      document.getElementById("aler").innerHTML = '<div class="alert alert-success">'+ msg+'</div>';
      $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").alert('close');
      });
    }
    </script>
    <script>
      // -----------------show form edit-------------
      $('body').delegate('#tabel-user #edit', 'click',function(e){
        var id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
          url: `/user/${id}/edit`,
          type: "GET",
          cache: false,
          success:function(response){
            //fill data to form
            $('#user_id').val(response.user_id);
            $('#namaE').val(response.nama);
            $('#addE').val(response.alamat);
            $('#emailE').val(response.email);
            $('#noHpE').val(response.noHp);
            $('#usernameE').val(response.username);
            $('#passE').val(response.password);

            //open modal
            $('#modalUbah').modal('show');
          }
        });
      });

      // update 
      $('#ubah-user').on('submit',function(e){
        // var formMessages = $(this).data('id');$('#');
        e.preventDefault();
        let user_id = $('#user_id').val();
        var data = $(this).serialize();
        $.ajax({
          url: `/user/${user_id}`,
          type: "PUT",
          cache: false,
          data:data,
          success:function(response) {
            refreshTable(response);  
            $('#modalUbah').modal('hide');
            showAlert(response.message);
            $('html').scrollTop(0);
            $("#ubah-user")[0].reset();
          }  
        });
      });
    
      // delete
      $('body').delegate('#tabel-user #del', 'click',function(e){
        var id = $(this).data('id');
        $('#del_id').val(id);
        // $('#namaKar').val(id);
        $('#modalHapus').modal('show');
      });

      $('#yakin_hapus').click(function () {
        var id = $('#del_id').val();
       
        $.ajax({
          url: "user/"+id,
          type: 'DELETE',
          dataType: "JSON",
          data: {
            "id": id, 
            "_token": $('#token').val()
          },
          success: function (response) {
            refreshTable(response);  
            $('#modalHapus').modal('hide');
            showAlert(response.message);
            $('html').scrollTop(0);
          }
        });
      })

      $('#tambah-user').on('submit',function(e){
          e.preventDefault();
          var data = $(this).serialize();
          var url = $(this).attr('action');
          var post = $(this).attr('method');
          $.ajax({
            type : post,
            url : url,
            data : data,
            dataTy : 'json',
            success:function(response) {
              refreshTable(response);  
              $('#modalTambah').modal('hide');
              showAlert(response.message);
              $('html').scrollTop(0); 
              $("#tambah-user")[0].reset();  
            }
          })
        })

        function refreshTable(response){
        $('#tabel-pegawai').html('');
        $.each(response.data.users, function (index, obj) {
          $('#tabel-pegawai').append('' +
            '<tr>' +
            '<td>' + (index+1) + '</td>' +
            '<td>' + obj.nama + '</td>' +
            '<td>' + obj.alamat + '</td>' +
            '<td>' + obj.email + '</td>' +
            '<td>' + obj.noHp + '</td>' +
            '<td>' + 
              '<div class="btn-group" role="group" aria-label="Second group">'+
              '<button type="button" class="btn btn-outline-warning" id="edit" data-id="'+ obj.user_id +'">'+
                '<i class="tf-icons bx bx-pencil"></i></button>'+
              '<button type="button" class="btn btn-outline-danger" id="del" data-id="'+ obj.user_id +'">'+
                '<i class="tf-icons bx bx-trash"></i></button> </div>'+
            '</td>' +
            '</tr>')
          });
    }
  </script>
  </body>
</html>
