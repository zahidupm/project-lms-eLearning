<div>
    <form wire:submit.prevent="search" class="flex items-center mb-4">
        <input class="lms-input" wire:model.lazy="search" type="text" placeholder="Search" required>
        <div class="ml-4"><button class="lms-btn" type="submit">Search</button></div>
    </form>

    @if (count($leads) > 0)
    <form wire:submit.prevent="admit">
        <div class="mb-4">
        <select wire:model.lazy="lead_id" class="lms-input" name="" id="">
            <option value="" class="">Select lead</option>
            @foreach ($leads as $lead)
                <option value="{{$lead->id}}">Name:{{$lead->name}} - Phone:{{$lead->phone}}</option>
            @endforeach
        </select>
    </div>

    @if (!empty($lead_id))
        <div class="mb-4">
            <select wire:change="courseSelected" wire:model.lay="course_id" class="lms-input">
                <option value="">Select lead</option>
                @foreach ($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if (!empty($selectedCourse))
        <p class="mb-4">Price: ${{number_format($selectedCourse->price, 2)}}</p>


        {{-- <div class="mb-4">
            <input wire:model.lay="payment" type="submit" step=".01" id="search" class="lms-input" placeholder="Payment now" type="text">
        </div> --}}

        @include('components.wire-loading-btn')
        @endif
    </form>
    @endif
</div>
