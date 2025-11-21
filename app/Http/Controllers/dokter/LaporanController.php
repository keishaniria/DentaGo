<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\dokter\Pemeriksaan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index()
    {
        $pemeriksaans = Pemeriksaan::with(['pasien', 'dokter'])
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        return view('dokter.laporan.index', compact('pemeriksaans'));
    }

    public function show($id)
    {
        $pemeriksaan = Pemeriksaan::with(['pasien', 'dokter'])
            ->findOrFail($id);

        return view('dokter.laporan.show', compact('pemeriksaan'));
    }

    public function exportExcel()
    {
        $pemeriksaans = Pemeriksaan::with(['pasien', 'dokter'])
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'A1' => 'ID',
            'B1' => 'Nama Pasien',
            'C1' => 'Keluhan',
            'D1' => 'Diagnosa',
            'E1' => 'Tindakan',
            'F1' => 'Resep Obat',
            'G1' => 'Tanggal Pemeriksaan',
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD9D9D9']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ]);

        $row = 2;
        foreach ($pemeriksaans as $item) {

            $resep = $item->resep;

            if (!is_array($resep)) {
                $decoded = json_decode($resep, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $resep = $decoded;
                }
            }

            if (is_array($resep)) {
                $resepText = collect($resep)
                    ->map(fn($r) => "{$r['nama']} ({$r['dosis']})")
                    ->implode(", ");
            } else {
                $resepText = "-";
            }
            
            $sheet->setCellValue("A{$row}", $item->id);
            $sheet->setCellValue("B{$row}", $item->pasien->nama_pasien ?? '-');
            $sheet->setCellValue("C{$row}", $item->keluhan);
            $sheet->setCellValue("D{$row}", $item->diagnosa);
            $sheet->setCellValue("E{$row}", $item->tindakan);
            $sheet->setCellValue("F{$row}", $resepText);
            $sheet->setCellValue("G{$row}", $item->tanggal_pemeriksaan);

            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ]
            ]);

            $row++;
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan_pemeriksaan.xlsx';

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
