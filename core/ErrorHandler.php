<?php

namespace Velty\Core;

class ErrorHandler
{
    public static function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
    }

    public static function handleException(\Throwable $e): void
    {
        http_response_code(500);

        // Sugerencia según el mensaje
        $solution = null;

        if (str_contains($e->getMessage(), 'View') && str_contains($e->getMessage(), 'not found')) {
            $solution = "Verifica que la vista exista en <code>app/Views</code> y que el nombre esté bien escrito. También asegúrate de no olvidar comillas simples en <code>view('nombre')</code>.";
        }

        $error = [
            'type' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace(),
            'solution' => $solution,
        ];


        self::render($error);
    }

    public static function handleError($errno, $errstr, $errfile, $errline): void
    {
        self::handleException(new \ErrorException($errstr, 0, $errno, $errfile, $errline));
    }

    protected static function render(array $error): void
    {
        $codePreview = self::getCodeSnippet($error['file'], $error['line']);
        $GLOBALS['codePreview'] = $codePreview;

        require dirname(__DIR__) . '/resources/views/errors/debug.php';
    }

    protected static function getCodeSnippet(string $file, int $line, int $padding = 5): string
    {
        if (!file_exists($file)) {
            return '<em class="text-red-400">Archivo no encontrado</em>';
        }
    
        $lines = file($file);
        $start = max($line - $padding - 1, 0);
        $end = min($line + $padding - 1, count($lines) - 1);
    
        $output = '';
        for ($i = $start; $i <= $end; $i++) {
            $currentLine = $i + 1;
            $lineContent = htmlspecialchars(rtrim($lines[$i]));
    
            // Preparar clases visuales
            $highlight = $currentLine === $line ? 'highlight-line' : '';
    
            // Añadir número de línea + contenido
            $output .= "<div class='line $highlight'>";
            $output .= "<span style='color: var(--muted); display: inline-block; width: 3em; text-align: right; margin-right: 1em;'>$currentLine</span>";
            $output .= "$lineContent</div>\n";
        }
    
        return $output;
    }
    



}
