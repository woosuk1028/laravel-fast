## Component

- INPUT
```ruby
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
```ruby
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
```ruby
<x-form.textarea
    width="12"
    name="memo"
    :value="$data->memo ?? null"
    rows="5"
    placeholder="메모"
/>
```
