@forelse ($kabupaten as $kabupaten)
    <option value="{{ $kabupaten->city_id }}">{{ $kabupaten->city_name }}</option>
@empty
    <option value="">Pilih Kota</option>
@endforelse
