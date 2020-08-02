<div>


    <label class="switch">
        @if ($status)
        <input wire:click="submit(0)" type="checkbox" checked/>
        @else
        <input wire:click="submit(1)" type="checkbox"/>
        @endif

        <span class="slider round"></span>
    </label>
</div>
