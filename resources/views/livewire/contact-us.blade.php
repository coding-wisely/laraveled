<div class="flex items-center justify-center min-h-screen">
    <flux:card class="w-full max-w-lg">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold ">Contact Us</h1>
            <p class="mt-2">Please fill in the form and we will be in contact</p>
        </div>
        <form wire:submit.prevent="submit" class="space-y-4 ">
            <flux:input 
                id="name" 
                label="Name" 
                wire:model="name" 
                placeholder="Enter your name" 
                class="mt-1 block w-full" />

            <flux:input 
                id="email" 
                label="Email" 
                type="email" 
                wire:model="email" 
                placeholder="Enter your email" 
                class="mt-1 block w-full" />

            <flux:input 
                id="phone" 
                label="Phone" 
                wire:model="phone" 
                placeholder="Enter your phone number" 
                class="mt-1 block w-full" />

            <flux:textarea 
                id="message" 
                label="Message" 
                wire:model="message" 
                placeholder="Type your message here..." 
                rows="4" 
                class="mt-1 block w-full" />

            <flux:button type="submit">
                Submit
            </flux:button>
        </form>
</flux:card>
</div>
