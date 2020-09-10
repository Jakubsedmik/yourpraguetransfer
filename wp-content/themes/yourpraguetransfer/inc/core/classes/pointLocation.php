<?php
/*
Description: The point-in-polygon algorithm allows you to check if a point is
inside a polygon or outside of it.
Author: Michaël Niessen (2009)
Website: http://AssemblySys.com
 
If you find this script useful, you can show your
appreciation by getting Michaël a cup of coffee ;)
PayPal: https://www.paypal.me/MichaelNiessen
 
As long as this notice (including author name and details) is included and
UNALTERED, this code is licensed under the GNU General Public License version 3:
http://www.gnu.org/licenses/gpl.html
*/
 
class pointLocation {
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?

    function pointInPolygon($point, $polygon, $pointOnVertex = true) {

        $this->pointOnVertex = $pointOnVertex;
 
        // Transform string coordinates into arrays with x and y values
        $vertices = $polygon;
 
        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return 2;
        }
 
        // Check if the point is inside the polygon or on the boundary
        $intersections = 0; 
        $vertices_count = count($vertices);

        // lng =x lat =y
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1->lat == $vertex2->lat and $vertex1->lat == $point->lat and $point->lng > min($vertex1->lng, $vertex2->lng) and $point->lng < max($vertex1->lng, $vertex2->lng)) { // Check if point is on an horizontal polygon boundary
                return 1;
            }
            if ($point->lat > min($vertex1->lat, $vertex2->lat) and $point->lat <= max($vertex1->lat, $vertex2->lat) and $point->lng <= max($vertex1->lng, $vertex2->lng) and $vertex1->lat != $vertex2->lat) {
                $xinters = ($point->lat - $vertex1->lat) * ($vertex2->lng - $vertex1->lng) / ($vertex2->lat - $vertex1->lat) + $vertex1->lng;
                if ($xinters == $point->lng) { // Check if point is on the polygon boundary (other than horizontal)
                    return 1;
                }
                if ($vertex1->lng == $vertex2->lng || $point->lng <= $xinters) {
                    $intersections++; 
                }
            } 
        }

        // If the number of edges we passed through is odd, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return true;
        } else {
            return false;
        }

    }
 
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }

 
}
?>