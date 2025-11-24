<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pasien\Reservasi;
use Carbon\Carbon;

class UpdateStatusReservasi extends Command
{
    protected $signature = 'reservasi:update-status';
    protected $description = 'Update status reservasi secara otomatis';

    public function handle()
    {
        $now = Carbon::now();

        $affected1 = Reservasi::where('status', 'Menunggu')
            ->whereDate('tanggal_reservasi', $now->toDateString())
            ->whereTime('jam', '<=', $now->format('H:i:s'))
            ->update(['status' => 'Proses']);

        $now1 = $now->copy()->subMinutes(1);

        $affected2 = Reservasi::where('status', 'Proses')
            ->whereRaw("TIMESTAMP(tanggal_reservasi, jam) <= ?", [
                $now1->toDateTimeString()
            ])
            ->update(['status' => 'Selesai']);

        $this->info("Menunggu → Proses : $affected1 row");
        $this->info("Proses → Selesai : $affected2 row");

        return Command::SUCCESS;
    }

}
