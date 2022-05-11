<div class="row">
	<div class="col-xl-6 col-xxl-5 d-flex">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Users</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM secuser")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
								Less sales than usual
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Tenants</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM mastenant")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span>
								More visitors than usual
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Warehouses</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM maswarehouse")->num_rows();
                                ?></h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
								More earnings than usual
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Products</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM masproduct")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
								Less orders than usual
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-xxl-5 d-flex">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Products</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM masproduct")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
								Less sales than usual
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Employees</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM masemployee")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span>
								More visitors than usual
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Total Earnings</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">$24.300</h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
								More earnings than usual
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Products</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-stockism">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-1 mb-3">
								<?php 
									echo $this->db->query("SELECT * FROM masproduct")->num_rows();
                                ?>
							</h1>
							<div class="mb-0">
								<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
								Less orders than usual
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
