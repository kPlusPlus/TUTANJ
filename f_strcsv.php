<?php

/**
 *  https://gist.github.com/johanmeiring/2894568
 * Convert a multi-dimensional, associative array to CSV data
 * @param  array $data the array of data
 * @return string       CSV text
 */
 
 
function str_putcsv($data,$header = false,$delimiter = ';',$enclosure = '"',$escape_char = '\\') {
        # Generate CSV data from array
        $fh = fopen('php://temp', 'rw'); # don't create a file, attempt to use memory instead

        # write out the headers
        if ($header == true)
        {
            fputcsv($fh, array_keys( current($data) ), $delimiter, $enclosure, $escape_char );
        }

        # write out the data
        foreach ( $data as $row ) {
            fputcsv($fh, $row, $delimiter, $enclosure, $escape_char);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
    }

    ?>
