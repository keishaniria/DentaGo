<?php

namespace App\Http\Controllers\Admin;

use App\Models\dokter\Pemeriksaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\dokter\RiwayatPemeriksaan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RiwayatController extends Controller
{
    //
    public function index()
    {
        $riwayat = RiwayatPemeriksaan::with(['pasien', 'dokter'])
            ->orderBy('tanggal_pemeriksaan', 'asc')
            ->get();

        return view('admin.pemeriksaan.riwayat-pemeriksaan', compact('riwayat'));
    }

    public function exportXlsx()
    {
        $filename = 'riwayat_pemeriksaan_' . now()->format('Y_m') . '.xlsx';

        $riwayat = Pemeriksaan::with(['pasien', 'dokter'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        // Import Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $columns = [
            'A1' => 'Tanggal Pemeriksaan',
            'B1' => 'Nama Pasien',
            'C1' => 'Nama Dokter',
            'D1' => 'Keluhan',
            'E1' => 'Diagnosa',
            'F1' => 'Tindakan',
            'G1' => 'Resep',
        ];

        foreach ($columns as $cell => $text) {
            $sheet->setCellValue($cell, $text);
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }

        $sheet->getStyle("A1:G1")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ]);
        
        // Data
        $row = 2;
        
        foreach ($riwayat as $r)
            {
            $resep = $r->resep;
            if (!is_array($resep)) {
                $decoded = json_decode($resep, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $resep = $decoded;
                }
            }

            if (is_array($resep)) {
                $resepText = collect($resep)
                    ->map(fn($item) => "{$item['nama']} ({$item['dosis']})")
                    ->implode(", ");
            } else {
                $resepText = "-";
            }
            
            $sheet->setCellValue("A$row", date('Y-m-d', strtotime($r->tanggal_pemeriksaan)));
            $sheet->setCellValue("B$row", $r->pasien->nama_pasien ?? '-');
            $sheet->setCellValue("C$row", $r->dokter->nama_dokter ?? '-');
            $sheet->setCellValue("D$row", $r->keluhan);
            $sheet->setCellValue("E$row", $r->diagnosa);
            $sheet->setCellValue("F$row", $r->tindakan);
            $sheet->setCellValue("G$row", $resepText);
            
            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ]
            ]);


            $row++;
        }
        // Auto width
        foreach (range('A','G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }



        // Export
        $writer = new Xlsx($spreadsheet);

        // Wajib pakai output buffer, biar tidak corrupt
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return response($excelOutput, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Cache-Control' => 'max-age=0'
        ]);

    }

}
