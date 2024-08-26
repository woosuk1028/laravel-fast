<div class="col-md-{{$width}}">
    <div class="form-group">
        <label for="{{ $name }}">{{ $placeholder }}</label>
        <input type="{{ $type }}"
               id="{{ $name }}"
               name="{{ $name }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               class="form-control {{ $errors && $errors->has($name) ? 'is-invalid' : '' }}"
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes }}
        >
        @if ($errors && $errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif
    </div>
</div>