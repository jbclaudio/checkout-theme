@props(['item' => [], 'key' => ''])
<x-tag {{ $attributes->merge([
    'class' => 'flex-1 text-left',
    'is' => isset($item['href']) ? 'a' : 'button',
    'href' => $item['href'] ?? '',
]) }}>
    @lang($item['heading'] ?? '')
    @if ($key === 'orders')
        <graphql query="{customer{orders{total_count}}}">
            <template v-if="data" slot-scope="{ data }">
                (@{{ data.customer?.orders?.total_count ?? 0 }})
            </template>
        </graphql>
    @endif
    <x-heroicon-o-chevron-right class="h-4" />
</x-tag>
