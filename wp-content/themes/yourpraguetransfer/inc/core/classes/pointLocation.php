<?php
/*
Description: The point-in-polygon algorithm allows you to check if a point is
inside a polygon or outside of it.
Author: Michaël Niessen (2009)
Website: http://AssemblySys.com

If you find this script useful, you can show your
appreciation by getting Michaël a cup of coffee ;)
donation to Michaël


As long as this notice (including author name and details) is included and
UNALTERED, this code is licensed under the GNU General Public License version 3:
http://www.gnu.org/licenses/gpl.html
*/

/**
 * Class pointLocation
 */
class pointLocation {
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?


    /**
     * Metoda která zjištuje zdali bod leží na polygonu
     * @param $point bod, jedná se o objekt specifikovaný vlastnostmi lat a lng
     * @param $polygon plygon je sestava objektů specifikovaných vlastnostmi lat a lng
     * @param bool $pointOnVertex
     * @return int 1 pokud je uvnitř polyhonu, 3 pokud je přesně na jednom z bodů, 2 pokud je přesně na hraně, 0 pokud neleží uvnitř
     */
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {
        $this->pointOnVertex = $pointOnVertex;

        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array();
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex);
        }

        $this->enclosePolygon($polygon);

        globalUtils::writeDebug($polygon);

        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return 3;
        }

        // Check if the point is inside the polygon or on the boundary
        $intersections = 0;
        $vertices_count = count($vertices);

        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1];
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return 2;
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return 2;
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }
        }
        // If the number of edges we passed through is odd, then it's in the polygon.
        if ($intersections % 2 != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }

    }

    function pointStringToCoordinates($pointString) {
        if(is_array($pointString)){
            return array("x" => $pointString['lng'], "y" => $pointString['lat']);
        }else{
            return array("x" => $pointString->lng, "y" => $pointString->lat);
        }
    }

    function enclosePolygon(&$polygon){
        $first = $polygon[0];
        $last = $polygon[count($polygon)-1];
        if($first !== $last){
            $polygon[] = $first;
        }
    }

}
?>