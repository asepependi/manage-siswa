<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a @class(['nav-link', 'active' => Request::is('home')]) aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a @class(['nav-link', 'active' => Request::is('kelas') || Request::is('kelas/create')]) href="{{ route('kelas.index') }}">Master Kelas</a>
          </li>
          <li class="nav-item">
            <a @class(['nav-link', 'active' => Request::is('siswa') || Request::is('siswa/create')]) href="{{ route('siswa.index') }}">Master Siswa</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> --}}
        </ul>
      </div>
    </div>
</nav>
