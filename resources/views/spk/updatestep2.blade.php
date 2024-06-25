<form action="{{ route('bobot.update', $bobot->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Field untuk Kriteria -->
    <label for="kriteria_id">Kriteria</label>
    <select name="kriteria_id" id="kriteria_id" class="form-control">
        @foreach($dataKriteria as $kriteria)
            <option value="{{ $kriteria->id }}" {{ $kriteria->id == $bobot->kriteria_id ? 'selected' : '' }}>
                {{ $kriteria->name }}
            </option>
        @endforeach
    </select>

    <!-- Field untuk Bobot -->
    <label for="bobot">Bobot</label>
    <input type="text" name="bobot" value="{{ $bobot->bobot }}" class="form-control">

    <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
        Update
    </button>
</form>
