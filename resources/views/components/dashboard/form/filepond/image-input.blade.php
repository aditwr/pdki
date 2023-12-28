@props(['name', 'label', 'containerClass', 'acceptedFileTypes' => 'null'])

<label class="w-full mb-3 form-control {{ $containerClass }}">
    <div class="label">
        <span class="text-base font-semibold label-text">{{ $label }}</span>
    </div>
    <input name="{{ $name }}" id="{{ $name }}" type="file" {{ $attributes }} />
    <input type="hidden" name="{{ $name }}_filename">
    <input type="hidden" name="{{ $name }}_tmp_folder">
    @error($name)
        <div class="label">
            <span class="font-bold label-text-alt text-error">{{ $message }}</span>
        </div>
    @enderror
</label>

@push('scripts_body')
    <script>
        // when document is ready, so FilePond has been loaded
        document.addEventListener('DOMContentLoaded', function() {
            const input{{ $name }} = document.getElementById('{{ $name }}');
            const pond{{ $name }} = FilePond.create(input{{ $name }}, {
                // stylePanelAspectRatio: "1:1",
                acceptedFileTypes: {!! $acceptedFileTypes ?? 'null' !!},
                server: {
                    process: {
                        url: "{{ route('upload') }}",
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        timeout: 7000,
                        onload: function(response) {
                            response = JSON.parse(response);
                            document.querySelector('input[name="{{ $name }}_filename"]')
                                .value = response.filename;
                            document.querySelector('input[name="{{ $name }}_tmp_folder"]')
                                .value = response.folder_tmp;
                            console.log(document.querySelector(
                                    'input[name="{{ $name }}_tmp_folder"]')
                                .value + '/' + document.querySelector(
                                    'input[name="{{ $name }}_filename"]').value);
                        },
                        onerror: null,
                        ondata: null
                    },
                },
                labelIdle: `Drag & Drop your picture or <span class="font-semibold filepond--label-action">Browse</span>`,
            });
        });
    </script>
@endpush
