<?php

namespace Velty\Core;

use Velty\Exceptions\ViewNotFoundException;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $path = __DIR__ . "/../resources/views/$view.php";

        if (!file_exists($path)) {
            throw new ViewNotFoundException($path);
        }

        $content = file_get_contents($path);

        // Reemplazar {{ variables }} por su valor escapado
        foreach ($data as $key => $value) {
            $escaped = htmlspecialchars((string) $value);
            $content = preg_replace("/{{\\s*$key\\s*}}/", $escaped, $content);
        }

        // Evaluar PHP y mostrar
        eval(' ?>' . $content . '<?php ');
    }
}
