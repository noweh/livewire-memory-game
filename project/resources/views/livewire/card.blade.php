<div
    @if(!$isLocked && !$isFlipped)wire:click="flipCard"@endif
    @if($isInError)wire:init="startTimer" class="error-cards"@endif
>
    En erreur: {{ $isInError }}
    Retournée: {{ $isFlipped }}
    Est verrouillée: {{ $isLocked }}
    <img src="{{ $src }}" alt="{{ $alt }}">
</div>


@if($isInError)
    @script
    <script>
        $wire.on('start-timer', () => {
            setTimeout(() => {
                $wire.dispatch('reset-error-cards', { id: String({{ $id }}) })
            }, 2000)
        })
    </script>
    @endscript
@endif
