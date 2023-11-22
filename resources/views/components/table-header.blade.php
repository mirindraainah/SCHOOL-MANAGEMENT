<th wire:click="setOrderField('{{ $name }}')" class="cursor-pointer">
    {{ $slot }}
    @if ($visible)
        @if ($direction === 'ASC')
            <i class="fas fa-caret-up ml-1"></i>
        @else
            <i class="fas fa-caret-down ml-1"></i>
        @endif
    @endif
</th>
