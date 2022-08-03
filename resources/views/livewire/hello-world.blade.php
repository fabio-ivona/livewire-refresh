<div class="p-10 relative flex items-center justify-center">
    <div class="flex flex-col items-center space-y-3">
        <h1 class="font-bold text-xl">Hello World!</h1>

        <span>Pleas enter your name:</span>

        <div>
            <input class="border-2" type="text" wire:model="name"/>
        </div>

        @if($name)
            <div class="text-lg">Hello {{$name}}</div>
        @endif
    </div>
</div>
