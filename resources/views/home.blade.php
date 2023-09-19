@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ccc7ad4dc8.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="assets/admin/js/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    @php
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    @endphp


    <script>
        $(document).ready(function() {
            // Show/hide the button based on scroll position
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#scrollBtn').fadeIn();
                } else {
                    $('#scrollBtn').fadeOut();
                }
            });

            // Scroll to top when the button is clicked
            $('#scrollBtn').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>

    <style>
        #scrollBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            cursor: pointer;
            padding: 15px;
            border: none;
            border-radius: 44%;
            background-color: #343A40;
            color: #fff;
        }

        .slider {
            border-radius: 10px;
            width: 95vw;
            max-width: 100vw;
            height: 50vh;
            margin: auto;
            margin-top: 70px;
            position: relative;
            overflow: hidden;
        }

        .slider .list {
            position: absolute;
            width: max-content;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            transition: 1s;
        }

        .slider .list .img {
            background-size: cover;
            background-position: center;
            width: 95vw;
            max-width: 100vw;
            height: 100%;
            object-fit: cover;
        }

        .slider .buttons {
            position: absolute;
            top: 45%;
            left: 5%;
            width: 90%;
            display: flex;
            justify-content: space-between;
        }

        .slider .buttons button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff5;
            color: #fff;
            border: none;
            font-family: monospace;
            font-weight: bold;
        }

        .slider .dots {
            position: absolute;
            bottom: 10px;
            left: 0;
            color: #fff;
            width: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .slider .dots li {
            list-style: none;
            width: 10px;
            height: 10px;
            background-color: #fff;
            margin: 10px;
            border-radius: 20px;
            transition: 0.5s;
        }

        .slider .dots li.active {
            width: 30px;
        }

        li {
            cursor: pointer;
        }

        .text {
            position: absolute;
            margin-bottom: 50px;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 25px 20px 25px;
            color: #ffffff;
            font-size: 24px;
            width: 95vw;
        }

        .img {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
            overflow: hidden;
            position: relative;
        }

        .vid {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
            overflow: hidden;
            position: relative;
        }

        .img-slideshow {
            width: 95vw;
        }

        .vid-slideshow {
            width: 95vw;
        }

        @media screen and (max-width: 768px) {
            .slider {
                height: 400px;
            }
        }
    </style>

    <button id="scrollBtn"> <i style="width: 30px;" class="fa-solid fa-arrow-up"></i></button>


    <div class="slider" style="">
        <div class="list">
            @foreach ($berita as $beritas)
                <div class="item">
                    @if (in_array(pathinfo($beritas->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="img" onclick="window.location.href = '/berita/detail/{{ $beritas->berita_id }}';">
                            <img class="img-slideshow" src="{{ asset('upload/' . $beritas->file) }}"
                                onclick="window.location.href = '/berita/detail/{{ $beritas->berita_id }}';" alt="">
                            <div class="text">{{ $beritas->information_berita }}</div>
                        </div>
                    @elseif (in_array(pathinfo($beritas->file, PATHINFO_EXTENSION), ['mp4', 'webm']))
                        <div class="vid" onclick="window.location.href = '/berita/detail/{{ $beritas->berita_id }}';">
                            <video class="vid-slideshow" autoplay muted>
                                <source src="{{ asset('upload/' . $beritas->file) }}"
                                    type="video/{{ pathinfo($beritas->file, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                            <div class="text">{{ $beritas->information_berita }}</div>
                        </div>
                    @else
                        Format not supported.
                    @endif
                </div>
            @endforeach
        </div>
        <div class="buttons">
            <button id="prev">
                < </button>
                    <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            @for ($i = 1; $i < count($berita); $i++)
                <li></li>
            @endfor
        </ul>
    </div>

    <div class="card border border-dark" style="margin-top: 30px;">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Menu Utama
            </h5>
        </div>


        <div class="card-body">
            <div class="row">
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-secondary">
                            System
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==11){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user') }}'"> <i class="fa fa-angle-right"></i>
                                    User</li>
                                <?php   }
                            if($menu['id_menu']==12){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user-group') }}'"> <i
                                        class="fa fa-angle-right"></i> User Group</li>
                                <?php   }
                            if($menu['id_menu']==13){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('Personil') }}'"> <i class="fa fa-angle-right"></i>
                                    Personil</li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Konfigurasi
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                           if($menu['id_menu']==21){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('location') }}'"> <i class="fa fa-angle-right"></i>
                                    Lokasi Patroli</li>
                                <?php   }
                            if($menu['id_menu']==22){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('patrol-schedule') }}'">
                                    <i class="fa fa-angle-right"></i> Jadwal Patroli
                                </li>
                                <?php   }
                            if($menu['id_menu']==23){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('personil-scheduling') }}'"> <i
                                        class="fa fa-angle-right"></i> Penjadwalan Personil</li>
                                <?php   }
                                if($menu['id_menu']==24){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('presensi') }}'"> <i class="fa fa-angle-right"></i>
                                    Presensi</li>
                                <?php   }
                                if($menu['id_menu']==25){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-presensi') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Presensi</li>
                                <?php   }
                                if($menu['id_menu']==26){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('berita') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                        Berita</li>
                                <?php   }
                            } 
                        ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Barang
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                           if($menu['id_menu']==31){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('equipment') }}'"> <i class="fa fa-angle-right"></i>
                                    List Barang</li>
                                <?php   }
                            if($menu['id_menu']==32){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('take-equipment') }}'">
                                    <i class="fa fa-angle-right"></i> Ambil Barang
                                </li>
                                <?php   }
                            if($menu['id_menu']==33){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('return-equipment') }}'"> <i
                                        class="fa fa-angle-right"></i> Pengembalian Barang</li>
                                <?php   }
                            } 
                        ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-secondary">
                            Penilaian Kesehatan
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                           if($menu['id_menu']==41){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('penilaian-kesehatan') }}'"> <i class="fa fa-angle-right"></i>
                                    Penilaian Kesehatan</li>
                                <?php   }
                            if($menu['id_menu']==42){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('kategori-penilaian-kesehatan') }}'">
                                    <i class="fa fa-angle-right"></i> Kategori Penilaian Kesehatan
                                </li>
                                <?php   }
                            if($menu['id_menu']==43){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('jadwal-penilaian-kesehatan') }}'"> <i
                                        class="fa fa-angle-right"></i> Jadwal Penilaian Kesehatan</li>
                                <?php   }
                            } 
                        ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <label for="">Pilih Penilaian Kesehatan Schedule ID</label>
    <select id="scheduleFilter">
        <option value="" selected hidden></option>
        @foreach ($jadwal_penilaian_kesehatan as $jpk)
            <option value="{{ $jpk['penilaian_kesehatan_schedule_id'] }}">{{ $bulan[$jpk['period_month']] }}
                {{ $jpk['period_year'] }}
            </option>
        @endforeach
    </select>

    <div id="container" style="width:100%; height:400px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var penilaian_kesehatan = <?php echo json_encode($penilaian_kesehatan); ?>;

            function updateChart(selectedScheduleId) {
                var chartData;
                var categoryColors = [];
                var uniqueColors = [];

                function generateRandomColor() {
                    // Menghasilkan warna acak dalam format hexadecimal
                    return '#' + Math.floor(Math.random() * 16777215).toString(16);
                }

                categoryColors[1] = 'black'; 
                categoryColors[2] = 'red';
                categoryColors[3] = 'yellow';
                categoryColors[4] = 'brown';
                categoryColors[5] = 'pink';
                categoryColors[6] = 'blue';
                categoryColors[7] = 'beige';
                categoryColors[8] = 'aqua';
                categoryColors[8] = 'orange';
                categoryColors[10] = 'maroon';

                chartData = penilaian_kesehatan.map(function(item) {
                    if (selectedScheduleId) {
                        var filteredChartData = penilaian_kesehatan.filter(function(item) {
                            return item.penilaian_kesehatan_schedule_id == selectedScheduleId;
                        });
                        chartData = filteredChartData.map(function(item) {
                            return {
                                name: item.penilaian_kesehatan_category_name,
                                personilName: item.name,
                                y: parseFloat(item.value),
                                color: categoryColors[item.penilaian_kesehatan_category_id]
                            };
                        });
                    } else {
                        chartData = penilaian_kesehatan.map(function(item) {
                            return {
                                name: item.penilaian_kesehatan_category_name,
                                personilName: item.name,
                                y: parseFloat(item.value),
                                color: categoryColors[item.penilaian_kesehatan_category_id]

                            };
                        });
                    }

                    chart = Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Diagram Penilaian Kesehatan'
                        },
                        xAxis: {
                            categories: chartData.map(function(item) {
                                return item.personilName;
                            })
                        },
                        yAxis: {
                            title: {
                                text: 'Nilai'
                            }
                        },
                        tooltip: {
                            headerFormat: '',
                            pointFormat: '<b>{point.personilName}</b><br/>' +
                                '-{point.name}: {point.y}<br> '
                        },
                        series: [{
                            showInLegend: false,
                            data: chartData
                        }],
                    });
                });

            }
            var dropdown = document.getElementById('scheduleFilter');
            dropdown.addEventListener('change', function() {
                var selectedScheduleId = this.value;
                updateChart(selectedScheduleId);
            });
            updateChart('');
        });
    </script>

    <script>
        let slider = document.querySelector('.slider .list');
        let items = document.querySelectorAll('.slider .list .item');
        let next = document.getElementById('next');
        let prev = document.getElementById('prev');
        let dots = document.querySelectorAll('.slider .dots li');

        let lengthItems = items.length - 1;
        let active = 0;
        next.onclick = function() {
            active = active + 1 <= lengthItems ? active + 1 : 0;
            reloadSlider();
        }
        prev.onclick = function() {
            active = active - 1 >= 0 ? active - 1 : lengthItems;
            reloadSlider();
        }
        let refreshInterval = setInterval(() => {
            next.click()
        }, 5000);

        function reloadSlider() {
            slider.style.left = -items[active].offsetLeft + 'px';
            let last_active_dot = document.querySelector('.slider .dots li.active');
            last_active_dot.classList.remove('active');
            dots[active].classList.add('active');

            clearInterval(refreshInterval);
            refreshInterval = setInterval(() => {
                next.click()
            }, 5000);


        }

        dots.forEach((li, key) => {
            li.addEventListener('click', () => {
                active = key;
                reloadSlider();
            })
        })
        window.onresize = function(event) {
            reloadSlider();
        };
    </script>



@stop

@section('css')

@stop

@section('js')

@stop
