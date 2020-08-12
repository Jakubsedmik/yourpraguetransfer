<?php


class Realsys_menu extends Walker_Nav_Menu {

	public function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;
		$output .= '<li class="nav-item">';


		//Add SPAN if no Permalink

		if( $permalink && strpos($permalink, "tel") === false ) {
			$output .= '<a class="' .  implode(" ", $item->classes) . ' s7_color-1 nav-link text-uppercase" href="' . $permalink . '">';
			$output .= $title;
		} else {
			$output .= '<a class="' .  implode(" ", $item->classes) . ' nav-link font-weight-bold ml-2" href="' . $permalink . '">';
			$output .= '<i class="fas fa-phone-alt text-white"></i><span class="mx-2 text-white">|</span><span class="text-white">' . $title . '</span>';
		}


		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}

		$output .= '</a>';


	}
}

