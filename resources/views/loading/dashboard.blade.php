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
          <div class="col-lg-12 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <style>
                        clock {
                            font-family: Arial, sans-serif;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            background-color: #f0f0f0;
                            margin: 0;
                        }
                        #clock {
                            font-size: 2em;
                            color: #333;
                        }
                    </style>
                    <h4>Waktu</h4>
                    <div class="clock" id="clock"></div>
                    <p>Waktu Indonesia Barat</p>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-12">
              <h4 class="card-header m-0 me-2 pb-3">Rekap Daily Report</h4>
              <canvas id="report" class="px-2"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>Rekap Data</h4>
                    <canvas id="pie"></canvas>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = timeString;
        }
        const ctx = document.getElementById('pie').getContext('2d');
        const report = document.getElementById('report').getContext('2d');
        setInterval(updateClock, 1000);
        updateClock();

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Planing', 'Loading'],
                datasets: [{
                    label: 'Report',
                    data: {{ $pie }},
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    fill: false,
                    hoverOffset: 4
                }]
            }
        });

        new Chart(report, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Report',
                    data: {{ $report }},
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection
