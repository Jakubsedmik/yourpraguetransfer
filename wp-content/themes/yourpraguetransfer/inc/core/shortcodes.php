<?php


add_shortcode("profile_link","profile_link");

function profile_link(){
	if(uzivatelClass::getUserLoggedId() !== false){
		return Tools::getFERoute("uzivatelClass",uzivatelClass::getUserLoggedId(), "detail");
	}else{
		return Tools::getFERoute("uzivatelClass",false, "login");
	}
}