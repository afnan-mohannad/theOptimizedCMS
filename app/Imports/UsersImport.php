<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading
{
    private $users;

    public function __construct()
    {
        $this->users = User::all(['id', 'name', 'email', 'created_at'])->pluck('id', 'name', 'email', 'created_at');
    }

    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make('123456789'),
            'role_id' => 3,
            'created_at' => $row['created_at']
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
