<?php

namespace JeyKeu\PHPLookup;

/**
 * Lookup methods similar to that of Excel.
 * @author Junaid Qadir Baloch <shekhanzai.baloch@gmail.com>
 */
class PHPLookup
{

    /**
     * 
     * @param strirng $lookupValue 
     * @param array $lookupSource An array of arrays to look value from
     * @param int $coulumnIndex
     * @param bool $exactMatch
     * @author Junaid Qadir Baloch <shekhanzai.baloch@gmail.com>
     */
    public function vLookup($lookupValue, array $lookupSource, $coulumnIndex, $exactMatch = FALSE) {
        $coulumnIndex--; //We need zero-based index
        $coulumnIndex = $coulumnIndex < 0 ? 0 : $coulumnIndex;
        $coulumnIndex = $coulumnIndex > sizeof($lookupSource) ? sizeof($lookupSource) - 1 : $coulumnIndex;

        $counter = 0;

        foreach ($lookupSource as $key => $column) {
            if ($counter == 0) {
                $firstColumn  = $column;
                $resultColumn = $firstColumn;
                if ($coulumnIndex == $counter) {
                    break;
                }
            } elseif ($counter == $coulumnIndex) {
                $resultColumn = $column;
                break;
            }
            $counter++;
        }

        $hasResult = FALSE;
        for ($i = 0; $i < count($firstColumn); $i++) {
            if ($i + 1 > sizeof($firstColumn)) {
                continue;
            }
            if (!$exactMatch && $firstColumn [$i + 1] > $lookupValue) {
                $hasResult = TRUE;
                break;
            } elseif ($firstColumn [$i] == $lookupValue) {
                $hasResult = TRUE;
                break;
            }
        }
        if (!$exactMatch && !$hasResult) {
            $i = sizeof($firstColumn) - 1;
            return $resultColumn[$i];
        } elseif (!$exactMatch && $hasResult) {
            return $resultColumn[$i];
        } else {
            return null;
        }
    }

}
