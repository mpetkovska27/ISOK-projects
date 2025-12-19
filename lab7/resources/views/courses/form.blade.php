<div class="mb-3">
    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title ?? '') }}" required>
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="summary" class="form-label">Summary <span class="text-danger">*</span></label>
    <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="4" required>{{ old('summary', $course->summary ?? '') }}</textarea>
    @error('summary')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
    <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" required>
        <option value="">Select a level</option>
        <option value="beginner" {{ old('level', $course->level ?? '') === 'beginner' ? 'selected' : '' }}>Beginner</option>
        <option value="intermediate" {{ old('level', $course->level ?? '') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
        <option value="advanced" {{ old('level', $course->level ?? '') === 'advanced' ? 'selected' : '' }}>Advanced</option>
    </select>
    @error('level')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', isset($course) && $course->start_date ? \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') : '') }}" required>
    @error('start_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="seats" class="form-label">Seats <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('seats') is-invalid @enderror" id="seats" name="seats" value="{{ old('seats', $course->seats ?? '') }}" min="1" required>
    @error('seats')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
