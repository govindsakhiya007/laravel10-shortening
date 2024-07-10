@extends('layouts.dashboard')
@section('title') Plans | List @endsection
@section('content')
<div class="row mt-3">
    <div class="col-lg-12 col-md-12">
        <!-- Breadcrumb Items -->
        <div class="card custom-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="text-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('upgrade.plan') }}">Plans</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Geckos List Layouts-->
        <div class="row d-flex align-items-center justify-content-center">
			<div class="col-lg-6 col-xl-3 col-md-6 col-sm-12">
				<form method="POST" action="{{ route('upgrade.plan') }}">
					@csrf
					<div class="card p-3 pricing-card">
						<div class="card-header text-justified pt-2">
							<p class="tx-18 font-weight-semibold mb-1">10 URLs (current)</p>
							<p class="text-justify font-weight-semibold mb-1"> <span class="tx-30 me-2">$</span><span class="tx-30 me-1">0</span><span class="tx-24"><span class="op-5 text-muted tx-20">/</span> month</span></p>
							<p class="tx-13 mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quos debitis aliquam .</p>
							<p class="tx-13 mb-1 text-primary font-weight-">Billed monthly on regular basis!</p>
						</div>
						<div class="card-body pt-2">
							<ul class="text-justify pricing-body text-muted ps-0">
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent rounded-pill tx-8"><i class="fa fa-check"></i></span>  <strong> 2 Free</strong> Domain Name</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong>3 </strong> One-Click Apps</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 1 </strong> Databases</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> Money </strong> BackGuarantee</li>
								<li class="mb-6"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 24/7</strong> support</li>
							</ul>
						</div>

						<input type="hidden" name="plan" value="10_URLs" />
						<div class="card-footer text-center border-top-0 pt-1">
							<button class="btn btn-lg btn-primary text-white btn-block" type="submit">
								<span class="ms-4 me-4">Select</span>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-xl-3 col-md-6 col-sm-12">
				<form method="POST" action="{{ route('upgrade.plan') }}">
					@csrf
					<div class="card p-3 border-primary pricing-card">
						<div class="card-header text-justified pt-2">
							<p class="tx-18 font-weight-semibold mb-1 pe-0">1000 URLs<span class=" tx-11 float-end badge bg-primary text-white px-2 py-1 rounded-pill mt-2">Most Popular</span></p>
							<p class="text-justify font-weight-semibold mb-1"> <span class="tx-30 me-2">$</span><span class="tx-30 me-1">1,299</span><span class="tx-24"><span class="op-5 text-muted tx-20">/</span> month</span></p>
							<p class="tx-13 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quos debitis aliquam .</p>
							<p class="tx-13 mb-1 text-primary font-weight-">Billed monthly on regular basis!</p>
						</div>
						<div class="card-body pt-2">
							<ul class="text-justify pricing-body text-muted ps-0">
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent rounded-pill tx-8"><i class="fa fa-check"></i></span>  <strong> 5 Free</strong> Domain Name</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong>5 </strong> One-Click Apps</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 3 </strong> Databases</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> Money </strong> BackGuarantee</li>
								<li class="mb-6"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 24/7</strong> support</li>
							</ul>
						</div>

						<input type="hidden" name="plan" value="1000_URLs" />
						<div class="card-footer text-center border-top-0 pt-1">
							<button class="btn btn-lg btn-primary text-white btn-block" type="submit">
								<span class="ms-4 me-4">Select</span>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-xl-3 col-md-6 col-sm-12">
				<form method="POST" action="{{ route('upgrade.plan') }}">
					@csrf
					<div class="card p-3 pricing-card">
						<div class="card-header text-justified pt-2">
							<p class="tx-18 font-weight-semibold mb-1">Unlimited</p>
							<p class="text-justify font-weight-semibold mb-1"> <span class="tx-30 me-2">$</span><span class="tx-30 me-1">79.9</span><span class="tx-24"><span class="op-5 text-muted tx-20">/</span> month</span></p>
							<p class="tx-13 mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quos debitis aliquam .</p>
							<p class="tx-13 mb-1 text-primary font-weight-">Billed monthly on regular basis!</p>
						</div>
						<div class="card-body pt-2">
							<ul class="text-justify pricing-body text-muted ps-0">
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent rounded-pill tx-8"><i class="fa fa-check"></i></span>  <strong> 1 Free</strong> Domain Name</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong>4 </strong> One-Click Apps</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 2 </strong> Databases</li>
								<li class="mb-4"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> Money </strong> BackGuarantee</li>
								<li class="mb-6"><span class="text-primary me-2 p-1 bg-primary-transparent  rounded-pill tx-8"><i class="fa fa-check"></i></span> <strong> 24/7</strong> support</li>
							</ul>
						</div>

						<input type="hidden" name="plan" value="Unlimited" />
						<div class="card-footer text-center border-top-0 pt-1" type="submit">
							<button class="btn btn-lg btn-primary text-white btn-block">
								<span class="ms-4 me-4">Select</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
@endsection
@section('scripts')@endsection
