<?php

class ReminderController
{

    function sendAlert()
    {

        date_default_timezone_set("America/Costa_Rica");

        // Fecha del recordatorio (ejemplo: 2021-03-01)
        $reminder_date = "2023-01-17";

        // Hora del recordatorio (ejemplo: 09:00:00)
        $reminder_time = "20:54:00";

        // Tiempo máximo de ejecución del script (ejemplo: 1 día)
        $minutes = 5;
        $seconds = $minutes % 60;
        // set_time_limit(5);

        while (true) {
            // Obtener fecha y hora actual
            $current_date = date("Y-m-d");
            $current_time = date("H:i:s");

            // Comprobar si ha llegado la fecha y hora del recordatorio
            if ($current_date == $reminder_date && $current_time == $reminder_time) {
                // Ejecutar acción del recordatorio (ejemplo: enviar un correo electrónico)
                echo "recordatoriooooooo";

                // Detener el script
                break;
            }

            // Esperar 1 segundo antes de volver a comprobar
            sleep(1);
        }
    }
}
