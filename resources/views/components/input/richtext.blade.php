@props(['name', 'value' => null])

@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush

<div x-data="{
    value: '{{ $value }}',
    init() {
        let quill = new Quill(this.$refs.quill, { theme: 'snow' });
        quill.root.innerHTML = this.value;
        quill.on('text-change', () => this.value = quill.root.innerHTML);
    },
}">
    <input type="hidden" name="{{ $name }}" x-model="value" class="bg-zinc-950" />
    <div x-ref="quill"></div>
</div>
