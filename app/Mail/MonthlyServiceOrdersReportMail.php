<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class MonthlyServiceOrdersReportMail extends Mailable
{
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
            subject: '📊 Relatório Mensal de Ordens de Serviço - ' . now()->format('m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.report-with-attachment',
            with: [
                'title' => 'Relatório Mensal de Ordens de Serviço',
                'messageText' => 'Segue em anexo o relatório mensal das ordens de serviço.',
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

