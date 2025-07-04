<?php

namespace App\Livewire\Admin\Tables;

use App\Jobs\UsersExportJob;
use Livewire\Component;
use Illuminate\Support\Facades\Bus;
use App\Livewire\Admin\Users\UsersData;
use Illuminate\Support\Facades\Storage;

class UsersExport extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false;

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;

        $batch = Bus::batch([
            new UsersExportJob(),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function downloadExport()
    {
        $this->dispatch('resetSelected')->to(UsersData::class);
        return Storage::download('public/dumps/data-dump.csv');
    }

    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function render()
    {
        return view('livewire.admin.tables.users-export');
    }
}