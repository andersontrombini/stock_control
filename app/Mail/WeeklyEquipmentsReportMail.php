<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyEquipmentsReportMail extends Mailable
{
    use SerializesModels;

    public $fileContent;
    public $fileName;

    public function __construct($fileContent, $fileName)
    {
        $this->fileContent = $fileContent;
        $this->fileName = $fileName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📦 Relatório Semanal de Equipamentos - ' . now()->format('d/m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.report-with-attachment',
            with: [
                'title' => 'Relatório Semanal de Equipamentos',
                'messageText' => 'Segue em anexo o relatório semanal de equipamentos.',
            ]
        );
    }

    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn () => $this->fileContent,
                $this->fileName
            )->withMime(
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ),
        ];
    }
}
