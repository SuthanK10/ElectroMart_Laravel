@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title"><span class="text-slate-900 dark:text-white">{{ $title }}</span></x-slot>
        <x-slot name="description"><span class="text-slate-600 dark:text-slate-400">{{ $description }}</span></x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 bg-white dark:bg-slate-950 sm:p-6 shadow sm:rounded-tl-[2rem] sm:rounded-tr-[2rem] {{ isset($actions) ? '' : 'sm:rounded-[2rem]' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 bg-slate-50 dark:bg-slate-900 text-end sm:px-6 shadow sm:rounded-bl-[2rem] sm:rounded-br-[2rem]">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
