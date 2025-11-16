<?php

namespace App\Http\Controllers\dokter;

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
        $pemeriksaan = Pemeriksaan::with(['pasien', 'dokter', 'resep'])->findOrFail($id);
        return view('dokter.laporan.show', compact('pemeriksaan'));
    }

    public function exportExcel()
    {
        // Data dummy
        $pemeriksaans = [
            [
                'id' => 1,
                'pasien' => (object)['nama_pasien' => 'Dwi Rahma'],
                'keluhan' => 'Demam dan pusing',
                'diagnosa' => 'Flu biasa',
                'tindakan' => 'Istirahat total',
                'tanggal_pemeriksaan' => '15-10-2025',
            ],
            [
                'id' => 2,
                'pasien' => (object)['nama_pasien' => 'Farhan Yusuf'],
                'keluhan' => 'Batuk berdahak',
                'diagnosa' => 'Infeksi saluran pernapasan',
                'tindakan' => 'Minum obat',
                'tanggal_pemeriksaan' => '15-10-2025',
            ],
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama Pasien');
        $sheet->setCellValue('C1', 'Keluhan');
        $sheet->setCellValue('D1', 'Diagnosa');
        $sheet->setCellValue('E1', 'Tindakan');
        $sheet->setCellValue('F1', 'Tanggal Pemeriksaan');

        $row = 2;
        foreach ($pemeriksaans as $item) {
            $sheet->setCellValue('A' . $row, $item['id']);
            $sheet->setCellValue('B' . $row, $item['pasien']->nama_pasien);
            $sheet->setCellValue('C' . $row, $item['keluhan']);
            $sheet->setCellValue('D' . $row, $item['diagnosa']);
            $sheet->setCellValue('E' . $row, $item['tindakan']);
            $sheet->setCellValue('F' . $row, $item['tanggal_pemeriksaan']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan_pemeriksaan_dummy.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
