<div class="container-fluid">
   <nav class="navbar bg-light">
      <div class="container">
         <a class="navbar-brand" href="#">
         <img src="{{ asset('assets/img/mirifica.png')}}" alt="mirifica srl" width="100" height="30">
         </a>
      </div>
   </nav>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">
         <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/')}}">Home</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#">Arrow</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#">Digi-Key</a>
         </li>
      </ul>
        <ul class="navbar-nav">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="url('element14')}}" id="navbarDarkDropdownMenuElement14" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Element14
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuElement14">
            <li><a class="dropdown-item" href="{{ url('element14')}}">Helps</a></li>
            <li><a class="dropdown-item" href="{{ url('element14/keywordSearch')}}">Keyword</a></li>
               <li><a class="dropdown-item" href="#">Part number</a></li>
            </ul>
         </li>
      </ul>
      <ul class="navbar-nav">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuMouser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Mouser
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuMouser">
               <li><a class="dropdown-item" href="{{ url('mouser')}}">Helps</a></li>
               <li><a class="dropdown-item" href="{{ url('mouser/keywordSearch')}}">keyword</a></li>
               <li><a class="dropdown-item" href="#">part number</a></li>
            </ul>
         </li>
      </ul>
      <ul class="navbar-nav">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuPM" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Plentymarket
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuPM">
               <li><a class="dropdown-item" href="{{ url('plentymarket')}}">Helps</a></li>
               <li><a class="dropdown-item" href="{{ url('plentymarket/checking')}}">Checking</a></li>
            </ul>
         </li>
      </ul>
      <ul class="navbar-nav">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuTrenz" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Trenz
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuTrenz">
               <li><a class="dropdown-item" href="{{ url('trenz')}}">Helps</a></li>
               <li><a class="dropdown-item" href="{{ url('trenz/getAll')}}">Articles</a></li>
            </ul>
         </li>
      </ul>
    </div>
</div>