<form wire:submit.prevent="formSubmit">
    <div class="mb-4">
        <label for="name" class="lms-label">Name</label>
        <input wire:model.lazy="name" id="name" type="text" class="lms-input">

        @error('name')
            <div class="text-red-500 text-xs mt-4">{{$message}}</div>
        @enderror
    </div>

    <h3 class="font-semibold  mb-2">Permissions</h3>
     <div class="flex flex-wrap -mx-4">
        @foreach ($permissions as $permission)
         <div class="w-1/3 px-4 mb-4">
            <label for="" class="inline-flex items-center">
                <input wire:model.lazy="selectedPermissions" type="checkbox"  class="form-checkbox" value="{{$permission->name}}">
                <span class="ml-2">{{$permission->name}}</span>
            </label>
        </div>
     @endforeach

     @error('selectedPermissions')
            <div class="text-red-500 text-xs mb-4 px-4">{{$message}}</div>
        @enderror
     </div>

     @include('components.wire-loading-btn')

</form>
