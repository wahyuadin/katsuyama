@extends('template.app')
@section('dashboard', 'active')

@section('content')
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Hallo, <b>{{ Auth::user()->nama }} !</b></h5>
                <p class="mb-4">
                  Selamat Datang Di Aplikasi <b>{{ config('app.name') }} !</b>
                </p>
                <a href="{{ route('profile'. '.'.Auth::user()->role) }}" class="btn btn-sm btn-outline-primary">Lihat Profile</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{ asset('assets/img/icons/unicons/chart-success.png') }}"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Planing</span>
                @php
                    $planing = App\Models\Planing::all()->count();
                @endphp
                <h3 class="card-title mb-2">{{ $planing }}</h3>
                <small class="text-success fw-semibold">Data</small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded" />
                  </div>
                </div>
                <span>Loading</span>
                @php
                    $loading = App\Models\Loading::all()->count();
                @endphp
                <h3 class="card-title text-nowrap mb-1">{{ $loading }}</h3>
                <small class="text-success fw-semibold">Data</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total report -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
              <h5 class="card-header m-0 me-2 pb-3">Daily Report</h5>
              <canvas id="report"></canvas>
          </div>
        </div>
      </div>
      <!--/ Total report -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                  </div>
                </div>
                <span class="d-block mb-1">Packing</span>
                @php
                    $packing = App\Models\Packing::all()->count();
                @endphp
                <h3 class="card-title text-nowrap mb-2">{{ $packing }}</h3>
                <small class="text-success fw-semibold">Data</small>
              </div>
            </div>
          </div>
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Data User</h5>
                      <span class="badge bg-label-warning rounded-pill">Tahun {{ date('Y'); }}</span>
                    </div>
                    <div class="mt-sm-auto">
                      @php
                          $user = App\Models\User::all()->count();
                      @endphp
                      <h3 class="mb-0">{{ $user }} User</h3>
                    </div>
                  </div>
                  <div id="profileReportChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const profileReportChartEl = document.querySelector('#profileReportChart'),
        profileReportChartConfig = {
            chart: {
                height: 80,
                type: 'line',
                toolbar: {
                show: false
                },
                dropShadow: {
                enabled: true,
                top: 10,
                left: 5,
                blur: 3,
                color: config.colors.warning,
                opacity: 0.15
                },
                sparkline: {
                enabled: true
                }
            },
            grid: {
                show: false,
                padding: {
                right: 8
                }
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            series: [
                {
                data: {{ $data_user }}
                }
            ],
            xaxis: {
                show: false,
                lines: {
                show: false
                },
                labels: {
                show: false
                },
                axisBorder: {
                show: false
                }
            },
            yaxis: {
                show: false
            }
        };
        if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
            const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
            profileReportChart.render();
        }

        const ctx = document.getElementById('report').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Report',
                    data: {{ $daily_report }},
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection
