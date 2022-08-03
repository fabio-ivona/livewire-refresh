# dummy project for unwanted full refreshes reproduction

This project is a reproduction of the issue described in 

steps to reproduce:

1. ensure docker + docker-compose are installed and working on your system
2. clone the project and enter the _livewire-refresh_ folder
3. start Laravel sail service, that will set up the docker containers:
   
```bash
./vendor/bin/sail up -d
```

4. install npm and composer dependencies

```bash
./vendor/bin/sail npm install
```
```bash
./vendor/bin/sail composer install
```

5. start vite server

```bash
./vendor/bin/sail npm run dev
```
6. open your browser at http://localhost

7. you will see a simple page with a basic livewire component that greets you when you type your name in the field

8. type your name in the text field

9. an "Hello <your name> message appears"

10. let's say you want to style the greetings message, to do so open the .blade file in `resources/views/livewire/hello-world.blade.php`

11. at the line 12, add a new tailwind class to the `div`: 

```diff
<div class="p-10 relative flex items-center justify-center">
    <div class="flex flex-col items-center space-y-3">
        <h1 class="font-bold text-xl">Hello World!</h1>

        <span>Pleas enter your name:</span>

        <div>
            <input class="border-2" type="text" wire:model="name"/>
        </div>

        @if($name)
-            <div class="text-lg">Hello {{$name}}</div>
+            <div class="text-lg text-red-500">Hello {{$name}}</div>
        @endif
    </div>
</div>
```

12. in your browser, you will see that the page had a full refresh and the livewire component has been reset to its initial state, compelling you to type again your name to see the result


**bonus**

if you comment out this code in `node_modules/vite/dist/node/chunks/dep-71eeb12cb.js` (the file may change):

```javascript
 // #3716, #3913
// For a non-CSS file, if all of its importers are CSS files (registered via
// PostCSS plugins) it should be considered a dead end and force full reload.
if (!isCSSRequest(node.url) &&
    [...node.importers].every((i) => isCSSRequest(i.url))) {
    return true;
}
```

you will see that you can easily change the `hello-world.blade.php` and immediately see the results, without having to re-type your name again
