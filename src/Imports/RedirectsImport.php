<?php

namespace Wotz\FilamentRedirects\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Wotz\FilamentRedirects\Models\Redirect;

class RedirectsImport implements ToCollection, WithBatchInserts, WithHeadingRow
{
    private int $defaultStatus;

    public function __construct()
    {
        $this->defaultStatus = config('filament-redirects.default-status');
    }

    public function collection(Collection $rows)
    {
        $rows->each(function ($row) {
            if ($row->has('from') && ($row['from'] !== null)) {
                $from = $this->removeTrailingSlashes($row['from']);
                $to = $this->removeTrailingSlashes($row['to']);

                if ($from && $from !== $to) {
                    Redirect::updateOrCreate(
                        [
                            'from' => $from,
                        ],
                        [
                            'to' => $to,
                            'status' => $row['status'] ?? $this->defaultStatus,
                            'online' => 1,
                        ]
                    );
                }
            }
        });
    }

    public function removeTrailingSlashes($value)
    {
        if (! $value) {
            return $value;
        }

        if (Str::endsWith($value, '/')) {
            return Str::replaceLast('/', '', $value);
        }

        return $value;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
