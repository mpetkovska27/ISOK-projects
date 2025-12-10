    <label for="name" class="form-label">Name </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name ?? '') }}" required>

    <label for="description" class="form-label">Description </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>

    <label for="type" class="form-label">Type </label>
    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $event->type ?? '') }}" required>

    <label for="date" class="form-label">Date </label>
    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', isset($event) && $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}" required>

    <label for="organizer_id" class="form-label">Organizer </label>
    <select class="form-select @error('organizer_id') is-invalid @enderror" id="organizer_id" name="organizer_id" required>
        <option value="">Select an organizer</option>
        @foreach($organizers as $organizer)
            <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id ?? '') == $organizer->id ? 'selected' : '' }}>
                {{ $organizer->name }}
            </option>
        @endforeach
    </select>
