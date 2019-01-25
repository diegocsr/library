@extends('layouts.app')
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Dashboard</h2>
                        </div>
                    <div class="panel-body">
                    Selamat datang di Menu Administrasi Larapus. Silahkan pilih menu administrasi yang diinginkan.
                    <h4>Statistik Penulis</h4>
                    <canvas id="chartPenulis" width="400" height="150"></canvas>
           {{--  </div>
            <div class="panel-body">
                    <h4>Statistik Pengguna</h4>
                    <canvas id="Mantap" width="400" height="150"></canvas>
            </div>
            <div class="panel-body">
                    <h4>Statistik Peminjaman dan Pengembalian</h4>
                    <canvas id="horizontalbar" width="400" height="150"></canvas>
            </div>
            <div class="panel-body">
                    <h4>Statistik Jumlah Buku</h4>
                    <canvas id="line" width="400" height="150"></canvas>
            </div> --}}
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/Chart.min.js"></script>
    <script>
        var data ={
            labels : {!! json_encode($authors) !!},
            datasets: [{
                label: 'Jumlah buku',
                data : {!! json_encode($books) !!},
                backgroundColor: "rgba(151,187,206,0.5)",
                borderColor:"rgba(151,187,205,0.8)",
            }]
        };

        var options = {
            scales:{
                yAxes: [{
                    ticks:{
                        beginAtZero:true,
                        stepSize:5
                    }
                }]
            }
        };

        var ctx= document.getElementById("chartPenulis").getContext("2d");

        var authorChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>

    <script>
        var data ={
            labels : {!! json_encode($class) !!},
            datasets: [{
                label: 'lsd',
                data : {!! json_encode($users) !!},
                backgroundColor: ["rgba(255,0,0,0.5)",
                "rgba(100,255,0,0.5)",
                "rgba(200,50,255,0.5)",
                "rgba(0,255,100,0.5)"]
            }]
        };
       
        var ctx= document.getElementById("Mantap");

        var mantapChart = new Chart(ctx, {
            type: 'polarArea',
            data: data

        });
    </script>

    <script>
        var data ={
            labels : {!! json_encode($kelas) !!},
            datasets: [{
                label: 'Peminjaman',
                data : {!! json_encode($borrow) !!},
                backgroundColor: ["rgba(255,0,0,0.5)",
                "rgba(100,255,0,0.5)",
                "rgba(200,50,255,0.5)",
                "rgba(0,255,100,0.5)"]
            },{
                label: 'Pengembalian',
                data : {!! json_encode($retur) !!},
                backgroundColor: ["rgba(255,0,0,0.5)",
                "rgba(100,255,0,0.5)",
                "rgba(200,50,255,0.5)",
                "rgba(0,255,100,0.5)"]
        }]};
       
        var ctx= document.getElementById("horizontalbar");

        var mantapChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: data

        });
    </script>
    <script>

        var data ={
            labels :{!! json_encode($jumlah) !!},
            datasets: [{
                label: 'Peminjaman',
                data : {!! json_encode($jumlah) !!},
                backgroundColor: ["rgba(255,0,0,0.5)",
                "rgba(100,255,0,0.5)",
                "rgba(200,50,255,0.5)",
                "rgba(0,255,100,0.5)"]
        }]};
       
        var ctx= document.getElementById("line");

        var mantapChart = new Chart(ctx, {
            type: 'line',
            data: data
        });
    </script>

    @endsection


