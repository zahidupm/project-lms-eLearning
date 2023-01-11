<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lead;
use Livewire\WithPagination;
use Flasher\Prime\FlasherInterface;

class LeadIndex extends Component
{
    public function render()
    {
        $leads = Lead::paginate(10);
        return view('livewire.lead-index', [
            'leads' => $leads
        ]);
    }

    public function leadDelete($id) {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        flash()->addSuccess('Lead Deleted Successfully');
    }
}
