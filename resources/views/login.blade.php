@include('layout/header')
<body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- message -->
          @if(session('errorLogin'))
          <div id="aler">
            <div class="alert alert-danger">{{session('errorLogin')}}</div>
          </div>
          @endif

          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-1">
                  <span class="app-brand-logo demo">
                    
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">SPPW</span>  
                </a>
              </div>
              <!-- /Logo -->
              <h5 class="mb-2 text-center">Sistem Pendataan Pembayaran Wifi</h5>
              <p class="mb-2 text-center">Masukkan username dan password</p>
              
              <form class="mb-3" id="form-login" action="{{ route('actionlogin') }}" method="POST">
              @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="username"
                    placeholder="Masukkan username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    @include('layout/jsUser')

    <!-- Main JS -->
    <script src="{{ URL::asset('assets/js/main.js')}}"></script>
    <script type="text/javascript">
      $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").alert('close');
      });
    </script>
    
  </body>
</html>

