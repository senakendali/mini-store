<?php
function formatRupiah(int $number): string
{
    return 'Rp' . number_format($number, 0, ',', '.');
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirectWithMessage(string $type, string $message): void
{
    header('Location: ../index.php?' . http_build_query([
        'type' => $type,
        'message' => $message,
    ]));
    exit;
}

function redirectToIndex(string $type, string $message): void
{
    header('Location: index.php?' . http_build_query([
        'type' => $type,
        'message' => $message,
    ]));
    exit;
}
