<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link  {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" >
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a href="/sampel" class="nav-link  {{ Request::is('sampel') ? 'active' : '' }}" >
              <span data-feather="file"></span>
              Sampel
            </a>
          </li>
          <li class="nav-item">
            <a href="/spk" class="nav-link  {{ Request::is('spk') ? 'active' : '' }}" >
              <span data-feather="shopping-cart"></span>
              Hasil SPK
            </a>
          </li>
        </ul>

        
      </div>
    </nav>