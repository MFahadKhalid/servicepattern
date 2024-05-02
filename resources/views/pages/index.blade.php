@extends('layouts.scaffold')
@push('titles')
    {{ $title ?? '' }}
@endpush
@section('content')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="fs-2 fw-semibold">Dashboard</div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item">
            <!-- if breadcrumb is single--><span>Home</span>
          </li>
          <li class="breadcrumb-item active"><span>Dashboard</span></li>
        </ol>
      </nav>
      <div class="row">
        <div class="col-xl-12">
          <div class="row">
            <div class="col-md-4">
                <div class="p-3 card">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="fa fa-globe"></i> Countries </h4>
                        </div>
                        <div class="col-md-6">
                            <h4 style="float: right;">0</h4>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
