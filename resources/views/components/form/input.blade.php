@props([
    'id' , 'name' , 'label' , 'value' => '' , 'type' => 'text',
])

<div class="mb-3">
    <label for="{{$name}}">{{ $label }}</label>
    <div>
        <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror" id="{{$id}}" name="{{$name}}"
            value="{{ old($name, $value) }}">
        @error($name)
            <p class="invalid-feedback"> {{ $message }}</p>
        @enderror
    </div>
</div>
