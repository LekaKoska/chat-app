@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 mb-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-sm text-green-700 dark:text-green-300 font-medium']) }}>
        ✅ {{ $status }}
    </div>
@endif
