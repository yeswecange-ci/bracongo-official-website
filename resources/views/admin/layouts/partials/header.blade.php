<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left">
					<ul class="navbar-nav header-left">
						<li class="nav-item d-flex align-items-center">
							{{-- @yield ne fonctionne pas ici (partial inclus via @section) ; @stack/@push oui --}}
							@stack('header-left')
						</li>
					</ul>
				</div>
				<ul class="navbar-nav header-right">
					@stack('header-actions')
					<li class="nav-item dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="{{ asset('admin/images/user.jpg') }}" width="20" alt>
							<div class="header-info ms-3">
								<span class="fs-14 font-w600 mb-0">{{ Auth::user()->name ?? 'Admin' }}</span>
								<small class="text-end font-w400">CMS</small>
							</div>
							<svg class="ms-2 mt-1 h-line" width="12" height="10" viewBox="0 0 12 10" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<rect y="0.5" width="12" height="1" fill="white" />
								<rect y="4.5" width="12" height="1" fill="white" />
								<rect y="8.5" width="12" height="1" fill="white" />
							</svg>
						</a>
						<div class="profile-detail card">
							<div class="card-body p-0">
								<div class="d-flex profile-media justify-content-between align-items-center">
									<div class="d-flex align-items-center">
										<img src="{{ asset('admin/images/profile-k.png') }}" alt="img">
										<div class="ms-3">
											<h4 class="mb-0">{{ Auth::user()->name ?? 'Admin BRACONGO' }}</h4>
											<p class="mb-0">{{ Auth::user()->email ?? 'admin@bracongo.cd' }}</p>
										</div>
									</div>
									<a href="javascript:void(0);">
										<div class="icon-box">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M18.379 8.44975L8.96409 17.8648C8.68489 18.144 8.32929 18.3343 7.9421 18.4117L5.00037 19.0001L5.58872 16.0583C5.66615 15.6711 5.85646 15.3155 6.13565 15.0363L15.5506 5.62132M18.379 8.44975L19.7932 7.03553C20.1837 6.64501 20.1837 6.01184 19.7932 5.62132L18.379 4.20711C17.9885 3.81658 17.3553 3.81658 16.9648 4.20711L15.5506 5.62132M18.379 8.44975L15.5506 5.62132"
													stroke="white" stroke-width="2" stroke-linecap="round"
													stroke-linejoin="round" />
											</svg>
										</div>
									</a>
								</div>
								<div class="media-box">
									<ul class="d-flex flex-colunm gap-2 flex-wrap">
										<li>
											<a href="javascript:void(0);">
												<div class="icon-box-lg">
													<svg width="40" height="40" viewBox="0 0 40 40" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M5 20C5 11.7157 11.7157 5 20 5C28.2843 5 35 11.7157 35 20C35 28.2843 28.2843 35 20 35C11.7157 35 5 28.2843 5 20Z"
															fill="white" fill-opacity="0.25" />
														<circle cx="19.9997" cy="16.6667" r="6.66667"
															fill="white" />
														<path fill-rule="evenodd" clip-rule="evenodd"
															d="M30.4335 30.5196C30.4904 30.6167 30.4727 30.7398 30.3915 30.8178C27.6957 33.4079 24.034 35 20.0004 35C15.9668 35 12.3051 33.4079 9.60933 30.8179C9.52818 30.7399 9.51048 30.6169 9.56735 30.5198C11.4843 27.2465 15.4363 25 20.0005 25C24.5645 25 28.5165 27.2464 30.4335 30.5196Z"
															fill="white" />
													</svg>
													<p>Profil</p>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<div class="icon-box-lg">
													<svg width="40" height="40" viewBox="0 0 40 40" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M6.66699 17.4718C6.66699 16.269 6.66699 15.6676 6.96569 15.1843C7.26439 14.701 7.80231 14.432 8.87814 13.8941L18.2115 9.22744C19.0893 8.78853 19.5282 8.56908 20.0003 8.56908C20.4725 8.56908 20.9114 8.78853 21.7892 9.22744L31.1225 13.8941C32.1983 14.432 32.7363 14.701 33.035 15.1843C33.3337 15.6676 33.3337 16.269 33.3337 17.4718V27.6663C33.3337 29.552 33.3337 30.4948 32.7479 31.0806C32.1621 31.6663 31.2193 31.6663 29.3337 31.6663H10.667C8.78137 31.6663 7.83857 31.6663 7.25278 31.0806C6.66699 30.4948 6.66699 29.552 6.66699 27.6663V17.4718Z"
															fill="white" fill-opacity="0.25" />
														<path
															d="M6.66699 29.667V16.9097C6.66699 16.7982 6.78434 16.7257 6.88407 16.7755L18.6587 22.6628C19.5033 23.0851 20.4974 23.0851 21.342 22.6628L33.1166 16.7755C33.2163 16.7257 33.3337 16.7982 33.3337 16.9097V29.667C33.3337 30.7716 32.4382 31.667 31.3337 31.667H8.66699C7.56242 31.667 6.66699 30.7716 6.66699 29.667Z"
															fill="white" />
													</svg>
													<p>Notifications</p>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<div class="icon-box-lg">
													<svg width="40" height="40" viewBox="0 0 40 40" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M9.97675 9.02568L5.65322 17.1923C4.92539 18.5671 4.56147 19.2545 4.56147 19.9997C4.56147 20.7448 4.92539 21.4322 5.65322 22.807L9.97675 30.9737C10.8001 32.5289 11.2118 33.3066 11.9258 33.7365C12.6398 34.1663 13.5197 34.1663 15.2795 34.1663H24.7212C26.4809 34.1663 27.3608 34.1663 28.0748 33.7365C28.7888 33.3066 29.2005 32.5289 30.0239 30.9737L34.3474 22.807C35.0753 21.4322 35.4392 20.7448 35.4392 19.9997C35.4392 19.2545 35.0753 18.5671 34.3474 17.1923L30.0239 9.02568C29.2005 7.47041 28.7888 6.69278 28.0748 6.26289C27.3608 5.83301 26.4809 5.83301 24.7212 5.83301H15.2795C13.5197 5.83301 12.6398 5.83301 11.9258 6.26289C11.2118 6.69278 10.8001 7.47041 9.97675 9.02568Z"
															fill="white" fill-opacity="0.25" />
														<circle cx="20" cy="20" r="5" fill="white" />
													</svg>
													<p>Settings</p>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<div class="icon-box-lg">
													<svg width="40" height="40" viewBox="0 0 40 40" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.25"
															d="M28.6325 11.2111L16.3162 7.10573C15.6687 6.88989 15 7.37186 15 8.05442V31.9462C15 32.6288 15.6687 33.1108 16.3162 32.8949L28.6325 28.7895C29.4491 28.5173 30 27.753 30 26.8921V13.1085C30 12.2476 29.4491 11.4834 28.6325 11.2111Z"
															fill="white" />
														<path
															d="M19.1663 15.833L23.333 19.9997M23.333 19.9997L19.1663 24.1663M23.333 19.9997H6.66634"
															stroke="white" stroke-linecap="round" />
													</svg>
													<p>Log Out</p>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
