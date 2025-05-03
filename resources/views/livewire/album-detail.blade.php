<div>

    @php $raw = json_decode($album->raw_discogs, true); @endphp

    <div class="row w-100" style="background-image: url('{{ $raw['images'][0]['uri'] }}'); background-size:100%;background-repeat: no-repeat;; min-height: 200px;">
        <div style="width: 100%; text-align: center; display: flex; align-items: center; justify-content: center; flex-direction: row; text-overflow: hidden;
        background: -webkit-linear-gradient(bottom, #F5F5F5, rgba(255,255,255,0));
        background: linear-gradient(to bottom, #F5F5F5, rgba(255,255,255,0));
        ">      
            <span style="text-align: center; font-size: 2.6rem; font-weight: bold; color: #ffffff;text-shadow: 1px 1px 2px black">{{ $raw['artists'][0]['name'] }} - {{ $raw['title'] }}</span>

        </div>
    </div>
    
    <div class="row w-100">
        <div class="col-12 mb-4 mt-4" style="display: flex; justify-content: space-between; ">
            <div class="col-10">        
                <h1 style="text-shadow: 1px 1px 2px rgb(160, 160, 160);color: #d60303;">{{ $raw['artists'][0]['name'] }}</h1>
                <h2 style="text-shadow: 1px 1px 2px rgb(160, 160, 160);color: #ec6409;">{{ $raw['title'] }} </h2>
                <h4 style="text-shadow: 1px 1px 2px rgb(75, 75, 75);color: #cfcfcf;">{{ $raw['year'] }} - {{ $raw['labels'][0]['name'] }}</h4>
                @if(isset($raw['notes']))
                    <p style="text-shadow: 1px 1px 2px rgb(75, 75, 75);color: #4e4e4e;">{{ $raw['notes'] }} </p>
                    
                @endif
                
            </div>
            <div class="m-0">
                <img src="{{ $raw['images'][0]['uri150'] }}" class="img-fluid">
            </div>
        </div>
    </div>
        
    @foreach ($raw['styles'] as $style) 
        <span class="badge bg-warning">{{ $style }} </span>
    @endforeach
    @foreach ($raw['genres'] as $genre) 
        <span class="badge bg-danger">{{ $genre }}</span>
    @endforeach


    <div class="row w-100">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="w-100"> &#x1F3B5;</th>
                    <th class="w-10"> &#x23F3;</th>
                    <th class="w-10"> &#x1F50A;</th>
                </tr>
            </thead>
            @foreach ($raw['tracklist'] as $track)
                <tr>
                    <td>{{ $track['title'] }}</td>
                    <td>{{ $track['duration'] }}</td>
                    <td><a href="" class="btn btn-success">Lire </a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <hr>
    <span style="font-size: 12px;">CB: {{ $album->barcode }} - REP: {{ $album->repertory }} - MAM - COMMUNAUTE D'AGGLOMERATION BÉZIERS MEDITERRANEE - 2025 (JB)</span>
    </div>
    
</div>
