<?php

add_filter( 'pt-ocdi/import_files', 'unicase_ocdi_import_files' );

add_action( 'pt-ocdi/after_import', 'unicase_ocdi_after_import_setup' );