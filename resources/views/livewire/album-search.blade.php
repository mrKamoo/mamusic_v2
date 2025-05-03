<div>
    <input 
    type="text" 
    class="form-control form-control-lg border-2 rounded-10 p-5 mb-4"
    placeholder="Recherchez parmis nos &#x1F449; {{ $count }} albums" 
    wire:model.live.debounce.1000ms="search" 
    />

    <div class="row">
    @foreach ($albums as $album)
        @php $raw = json_decode($album->raw_discogs, true); @endphp
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
            <div class="card w-100">
            @if(isset($raw['images'][0]['uri']))
                <img src="{{ $raw['images'][0]['uri'] }}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            @else
                <img src="https://placehold.co/200x200?text={{ $album->artist ?? ($raw['artists'][0]['name'] ?? 'Non renseigné') }}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            @endif

            <div class="card-body">
                <h5 class="card-title text-truncate text-center mb-2">{{ $album->artist ?? ($raw['artists'][0]['name'] ?? 'Non renseigné') }}</h5>
                <p class="card-text text-truncate text-center">{{ ($raw['title'] ?? 'Titre inconnu') }}</p>
                <a href="/albums/{{ $album->id }}" class="btn btn-success w-100">Ecouter</a>
            </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
