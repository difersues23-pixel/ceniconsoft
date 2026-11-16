<?php

// Parámetros del sistema (RN-044): se guardan en configuración, no en una tabla.
return [
    'intentos_fallidos_max'        => env('CENI_INTENTOS_FALLIDOS_MAX', 3),
    'minutos_bloqueo'              => env('CENI_MINUTOS_BLOQUEO', 15),       // [SUPUESTO] no definido en los documentos
    'minutos_inactividad'          => env('CENI_MINUTOS_INACTIVIDAD', 15),
    'dias_recordatorio_pago'       => env('CENI_DIAS_RECORDATORIO_PAGO', 10),
    'dias_antelacion_alerta_mant'  => env('CENI_DIAS_ANTELACION_ALERTA_MANT', 15),
    'anios_mora_retiro'            => 4,
];
