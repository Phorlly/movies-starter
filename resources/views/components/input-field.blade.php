<div class="mb-4">
    <label for="{{ $name }}"
        class="block text-sm font-medium text-card-foreground mb-2">{{ $text }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        class="bg-input border border-border text-foreground rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary"
        placeholder="Enter {{ $text }}" {{ $required }} {{ $required }}>
</div>
