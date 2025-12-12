
    <label for="name" class="form-label">Name </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $organizer->name ?? '') }}" required>

    <label for="email" class="form-label">Email </label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $organizer->email ?? '') }}" required>

    <label for="phone" class="form-label">Phone </label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $organizer->phone ?? '') }}" required>
