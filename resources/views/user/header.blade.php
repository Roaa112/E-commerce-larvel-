 <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{url('redirect')}}"><h2>Sixteen <em>Clothing</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('')}}">{{__('message.Home')}}
                  <span class="sr-only">(current)</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('MyCart')}}">{{__('message.MyCart')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">{{__('message.About Us')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">{{__('message.Contact Us')}}</a>
              </li>

              @if(session()->has("lang") && session()->get("lang")=="ar")
              <li class="nav-item">
                <a class="nav-link" href="{{url('Change/en')}}">English</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{url('Change/ar')}}">Arbic</a>
              </li>
              @endif

              @guest
              <li class="nav-item">
                <a class="nav-link" href="{{url('dashboard')}}">{{__('message.Login')}} </a>
              </li>
              @endguest
             @auth
              <a class="nav-link" href="{{ url('dashboard') }}">
                <div class="navbar-profile">
                <div class="profile-info">
                  <img class="img-xs rounded-circle" src="{{ asset('admin/template/assets/images/faces/face15.jpg') }}" width="30" alt="{{ Auth::user()->name }}">
                  <p class="mb-0 d-none d-sm-inline-block navbar-profile-name">{{ Auth::user()->name }}</p>
               </div>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
               </div>
              </a>
              @endauth
             
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
            </ul>
          </div>
        </div>
      </nav>
    </header>