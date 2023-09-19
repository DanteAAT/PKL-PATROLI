
    @php
        use Illuminate\Support\Facades\Request;
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp



        <div class="card-body">
            <div class="visible-print text-center" style="">
                <h1 style="padding: 10px;">Scan Disini!!</h1>
                @foreach ($location as $loc)
                {!! QrCode::size(1)->generate($location['location_id']) !!}
                <h4 style="margin-top:30px">Lantai {{ $location['location_floor'] }}</h4>
                <h2 style="margin-top:10px">{{ $location['location_name'] }}</h2>
                @endforeach
            </div>
        </div>

        
        
       
