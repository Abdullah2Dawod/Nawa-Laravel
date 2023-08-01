@props(['id', 'name', 'label', 'value' => ''])

<div class="mb-3">
    <label for="{{$id}}">{{ $label }}</label>
    <div>
        <textarea class="form-control @error($name) is-invalid @enderror" rows="2" id="{{ $id }}"
            name="{{ $name }}">{{ old($name, $value) }}</textarea>
        @error($name)
            <p class="invalid-feedback"> {{ $message }}</p>
        @enderror
    </div>
</div>
