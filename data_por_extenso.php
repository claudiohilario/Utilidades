<?php
        /**
         * Data por extenso
         * Output: Sábado, 14 de Janeiro de 2017
         */
        setlocale(LC_ALL, 'pt_PT', 'pt_PT.utf-8', 'pt_PT.utf-8', 'portuguese');
        date_default_timezone_set('Europe/Lisbon');
        echo strftime('%A, %d de %B de %Y', strtotime('today'));
        
