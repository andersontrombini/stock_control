@props(['id', 'name', 'required' => false])

<select id="{{ $id }}" name="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 
                    bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 
                    focus:border-orange-500 dark:focus:border-orange-400
                    focus:ring-orange-500 dark:focus:ring-orange-400
                    px-3 py-2'
    ]) }}
    @if($required) required @endif
>
    {{ $slot }}
</select>