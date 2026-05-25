<?php

namespace App\Imports;

use App\Models\Sample;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow; // Add this
use Illuminate\Support\Facades\Auth;

class SampleImport implements ToModel, WithStartRow { // Add WithStartRow here

    /**
     * This tells the importer to start reading from row 2
     * skipping the header row (row 1).
     */

    public function startRow(): int {
        return 2;
    }

    public function model(array $row) {
        // Now row 1 (headers) is ignored, and $row[0] starts from data in Row 2
        return new Sample([
            'user_id' => Auth::id(),
            'company_id' => is_numeric($row[0]) ? $row[0] : null,
            'buyer_id' => is_numeric($row[1]) ? $row[1] : null,
            'po' => $row[2] ?? null,
            'season' => $row[3] ?? null,
            'style' => $row[4] ?? null,
            'category_id' => is_numeric($row[5]) ? $row[5] : null,
            'name' => $row[6] ?? null,
            'color' => $row[7] ?? null,
            'size_range' => $row[8] ?? null,
            'sample_type_id' => is_numeric($row[9]) ? $row[9] : null,
            'qty' => $row[10] ?? 0,
            'tag' => $row[11] ?? null,
            'location' => $row[12] ?? null,
            'featured' => false,
            'status' => true,
        ]);
    }
}
