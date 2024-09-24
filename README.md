<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Component

- INPUT
```
<x-form.input
    width="6"
    type="text"
    name="app_key"
    placeholder="앱키"
    :value="$data->app_key ?? null"
    :disabled="$mode=='수정'?'disabled':''"
    :errors="$errors"
    oninput="handleOnInput(this, 5)"
/>
```

  - SELECT
```
<x-form.select
    width="6"
    name="run_state"
    label="상태"
    :options="$arrays['run_state']"
    :selected="old('run_state', $data->run_state ?? null)"
    :errors="$errors"
/>
```

- TEXTAREA
```
<x-form.textarea
    width="12"
    name="memo"
    :value="$data->memo ?? null"
    rows="5"
    placeholder="메모"
/>
```
