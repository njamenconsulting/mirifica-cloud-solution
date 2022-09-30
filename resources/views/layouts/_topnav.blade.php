<div class="container-fluid">
	<a class="navbar-brand" href="#">Brand</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav">
			<li class="nav-item active"> <a class="nav-link" href="#">Home </a> </li>
			<li class="nav-item"><a class="nav-link" href="#"> About </a></li>
			<li class="nav-item"><a class="nav-link" href="#"> Services </a></li>
			<li class="nav-item dropdown has-megamenu">
				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Mega menu  </a>
				<div class="dropdown-menu megamenu" role="menu">
					<div class="row g-3">
						<div class="col-lg-3 col-6">
							<div class="col-megamenu">
								<h6 class="title">Title Menu One</h6>
								<ul class="list-unstyled">
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
								</ul>
							</div>  <!-- col-megamenu.// -->
						</div><!-- end col-3 -->
						<div class="col-lg-3 col-6">
							<div class="col-megamenu">
								<h6 class="title">Title Menu Two</h6>
								<ul class="list-unstyled">
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
								</ul>
							</div>  <!-- col-megamenu.// -->
						</div><!-- end col-3 -->
						<div class="col-lg-3 col-6">
							<div class="col-megamenu">
								<h6 class="title">Title Menu Three</h6>
								<ul class="list-unstyled">
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
								</ul>
							</div>  <!-- col-megamenu.// -->
						</div>    
						<div class="col-lg-3 col-6">
							<div class="col-megamenu">
								<h6 class="title">Title Menu Four</h6>
								<ul class="list-unstyled">
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
									<li><a href="#">Custom Menu</a></li>
								</ul>
							</div>  <!-- col-megamenu.// -->
						</div><!-- end col-3 -->
					</div><!-- end row --> 
				</div> <!-- dropdown-mega-menu.// -->
			</li>
		</ul>
		<ul class="navbar-nav ms-auto">
			<li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> PlentyMarket </a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="{{ route('plenty-articles.index')}}"><i class="bi bi-activity"></i> Index</a></li>
				  <li><a class="dropdown-item" href="{{ route('plenty-articles.create')}}"><i class="bi bi-activity"></i> Create</a></li>
				  <li><a class="dropdown-item" href="{{ route('plenty-articles.edit',1)}}"><i class="bi bi-activity"></i> update</a></li>
				  <li><a class="dropdown-item" href="{{ url('update-sales-price')}}"><i class="bi bi-cloud-plus"></i> Update Price</a></li>
				  <li><a class="dropdown-item" href="{{ url('update-stock')}}"><i class="bi bi-cloud-plus"></i> Update Stock</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Trenz</a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="{{ route('trenz-articles.index')}}"><i class="bi bi-activity"></i> Index</a></li>
				  <li><a class="dropdown-item" href="{{ route('trenz-articles.create')}}"><i class="bi bi-activity"></i> Create</a></li>
				  <li><a class="dropdown-item" href="{{ route('trenz-articles.edit',1)}}"><i class="bi bi-activity"></i> Update</a></li>
				  <li><a class="dropdown-item" href="#"><i class="bi bi-cloud-plus"></i> Delete</a></li>
			    </ul>
			</li>
            <li class="nav-item dropdown">
			
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i> Hey'Yves!
                </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Setting</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-door-closed"></i> Logout</a></li>
                    </ul>
            </li>
		</ul>

	</div> <!-- navbar-collapse.// -->
    
</div> <!-- container-fluid.// -->