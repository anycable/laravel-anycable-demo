<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\PackageSent;
use App\Events\PackageSentLog;

class DeliveryHistory extends Component
{
    public array $packageStatuses = [
    ];

    public string $status = '';

    public function submitStatus()
    {
        PackageSent::dispatch(auth()->user()->name, $this->status, Carbon::now());
        PackageSentLog::dispatch("User ".auth()->user()->name." updated status to: ".$this->status);

        $this->reset('status');
    }

    #[On('echo-private:delivery,PackageSent')]
    public function onPackageSent($event)
    {
        $this->packageStatuses[] = $event;
    }

    public function render()
    {
        return view('livewire.delivery-history');
    }
}
