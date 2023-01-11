<div>
    <form wire:submit.prevent="submitForm">
        <div class="mb-4">
            <label for="" class="lms-label">Name</label>
            <input wire:model="name" type="text" class="lms-input">

            @error('name')
             <div class="text-red-500 text-xs">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="" class="lms-label">Email</label>
            <input wire:model="email" type="email" class="lms-input">

            @error('email')
             <div class="text-red-500 text-xs mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="" class="lms-label">Phone</label>
            <input wire:model="phone" type="tel" class="lms-input">

            @error('phone')
             <div class="text-red-500 text-xs">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="lms-btn">Update</button>
    </form>
</div>
