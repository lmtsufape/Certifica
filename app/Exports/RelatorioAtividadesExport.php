<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RelatorioAtividadesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    private $atividades;
    private $acaoTitulo;

    public function __construct($atividades, string $acaoTitulo = '')
    {
        $this->atividades = collect($atividades);
        $this->acaoTitulo = $acaoTitulo;
    }

    public function collection(): Collection
    {
        return $this->atividades;
    }

    public function headings(): array
    {
        return [
            'Acao',
            'Atividade/Função',
            'Data Inicio',
            'Data Fim',
            'Integrantes',
            'Total de Certificados',
        ];
    }

    public function map($atividade): array
    {
        return [
            $this->acaoTitulo,
            $atividade->descricao,
            $atividade->data_inicio ? date('d/m/Y', strtotime($atividade->data_inicio)) : '',
            $atividade->data_fim ? date('d/m/Y', strtotime($atividade->data_fim)) : '',
            $atividade->lista_nomes ?? $atividade->nome_participantes ?? '',
            ($atividade->total === null || $atividade->total === '') ? '0' : $atividade->total,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestColumn = $sheet->getHighestColumn();
                $highestRow = max(1, $sheet->getHighestRow());
                $fullRange = 'A1:' . $highestColumn . $highestRow;
                $headerRange = 'A1:' . $highestColumn . '1';

                $sheet->freezePane('A2');
                $sheet->setAutoFilter($headerRange);
                $sheet->getRowDimension(1)->setRowHeight(24);
                $sheet->getStyle($fullRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF972E3F'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle($fullRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FFD9D9D9'],
                        ],
                    ],
                ]);

                $sheet->getStyle('A:F')->getAlignment()->setWrapText(true);
                $sheet->getStyle('C:D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F2:F' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
