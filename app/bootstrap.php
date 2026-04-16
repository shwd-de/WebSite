<?php
declare(strict_types=1);

/**
 * Kleiner Bootstrap für die SHWD-V1.
 *
 * Lädt eine einfache .env-Datei und stellt eine env()-Hilfsfunktion bereit.
 * In der ersten Version nutzt das Kontaktformular standardmäßig PHP mail().
 * SMTP-Variablen können bereits in .env hinterlegt werden, werden aber erst
 * genutzt, wenn der Versand später erweitert wird.
 */

static $loaded = false;

if (!$loaded) {
    load_env(__DIR__ . '/../.env');
    $loaded = true;
}

function load_env(string $path): void
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }

        [$key, $value] = $parts;
        $key = trim($key);
        $value = trim($value);

        if ($key === '') {
            continue;
        }

        if ((str_starts_with($value, '"') && str_ends_with($value, '"')) || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
            $value = substr($value, 1, -1);
        }

        $_ENV[$key] = $value;
        putenv($key . '=' . $value);
    }
}

function env(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? getenv($key);
    if ($value === false || $value === null || $value === '') {
        return $default;
    }
    return (string)$value;
}
