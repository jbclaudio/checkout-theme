@props(['shipping' => false, 'billing' => false, 'dynamicType' => false, 'check' => false])

<address-card
    {{ $attributes->whereStartsWith('v-') }}
    @if (!$dynamicType) :shipping="{{ var_export($shipping) }}"
        :billing="{{ var_export($billing) }}" @endif
    v-slot="{ address, billing, shipping, isEmpty }"
>
    <div
        {{ $attributes->whereDoesntStartWith('v-') }}
        v-if="!isEmpty"
    >
        <div class="flex h-full flex-col">
            @if ($check)
                <template v-if="{{ $check }}">
                    <div class="absolute inset-y-0 left-0 w-1 rounded-l bg-ct-accent"></div>
                    <x-heroicon-s-check class="absolute right-7 top-7 w-5 text-ct-accent" />
                </template>
            @endif
            <x-rapidez-ct::title.lg class="mb-4 pr-8">
                <template v-if="billing && shipping">@lang('Shipping & billing address')</template>
                <template v-else-if="shipping">@lang('Shipping address')</template>
                <template v-else-if="billing">@lang('Billing address')</template>
                <template v-else>@lang('Address')</template>
            </x-rapidez-ct::title.lg>
            <div class="flex flex-1 flex-wrap justify-between">
                <ul class="flex flex-col gap-1">
                    <li
                        v-for="data in address"
                        v-text="data"
                    ></li>
                </ul>
                @if (!empty($slot))
                    <div class="mt-auto flex flex-col self-end">
                        {{ $slot }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</address-card>
