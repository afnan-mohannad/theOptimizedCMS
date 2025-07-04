<?php

namespace App\Livewire\Admin\Tables;

use Livewire\Component;
use App\Jobs\UsersImportJob;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Bus;
use App\Livewire\Admin\Users\UsersData;
use Illuminate\Support\Facades\Storage;

class UsersImport extends Component
{
    use WithFileUploads;

    public $batchId;
    public $importFile;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:csv',
        ]);

        $this->importing = true;
        $this->importFilePath = $this->importFile->store('imports');

        $batch = Bus::batch([
            new UsersImportJob($this->importFilePath),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }

        $this->dispatch('refreshData')->to(UsersData::class);

    }

    public function render()
    {
        return view('livewire.admin.tables.users-import');
    }
}